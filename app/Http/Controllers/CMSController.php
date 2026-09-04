<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CMSController extends Controller
{
    public function index()
    {
        $rows = DB::table('cms_contents')->get();
        $cmsData = [];
        foreach ($rows as $row) {
            $cmsData[$row->key] = json_decode($row->content, true);
        }
        return response()->json($cmsData);
    }

    public function show($key)
    {
        $row = DB::table('cms_contents')->where('key', $key)->first();
        if (!$row) {
            return response()->json([]);
        }
        return response()->json(json_decode($row->content, true));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        foreach ($data as $key => $val) {
            DB::table('cms_contents')->updateOrInsert(
                ['key' => $key],
                [
                    'content' => json_encode($val),
                    'updated_at' => now(),
                    'created_at' => now()
                ]
            );
        }

        return response()->json(['success' => true]);
    }

    public function storeKey(Request $request, $key)
    {
        $content = $request->all();

        DB::table('cms_contents')->updateOrInsert(
            ['key' => $key],
            [
                'content' => json_encode($content),
                'updated_at' => now(),
                'created_at' => now()
            ]
        );

        return response()->json(['success' => true, 'key' => $key, 'content' => $content]);
    }
}
