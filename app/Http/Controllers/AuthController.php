<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:4',
        ]);

        $existing = DB::table('users')->where('email', $request->email)->first();
        if ($existing) {
            return response()->json(['error' => 'User with this email already exists.'], 400);
        }

        $id = 'u_' . time();
        $user = [
            'id' => $id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone ?? '',
            'password' => Hash::make($request->password),
            'role' => 'customer',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        DB::table('users')->insert($user);

        return response()->json([
            'success' => true,
            'token' => Str::random(40),
            'user' => [
                'id' => $id,
                'name' => $request->name,
                'email' => $request->email,
                'role' => 'customer'
            ]
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = DB::table('users')->where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            // Also fallback for plain text if migrated legacy seeders
            if (!$user || ($user->password !== $request->password && !Hash::check($request->password, $user->password))) {
                return response()->json(['error' => 'Invalid email or password.'], 401);
            }
        }

        if ($user->role === 'admin') {
            DB::table('audit_logs')->insert([
                'userId' => $user->id,
                'userName' => $user->name,
                'action' => 'ADMIN_LOGIN',
                'details' => 'Admin authenticated into dashboard',
                'ipAddress' => $request->ip(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return response()->json([
            'success' => true,
            'token' => Str::random(40),
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role
            ]
        ]);
    }
}
