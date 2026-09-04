@extends('layouts.admin')

@section('title', 'Audit Logs - BikroyBD24 Admin')
@section('page_title', 'System Audit & Activity Logs')

@section('content')
<div class="space-y-6">
    <div>
        <h2 class="text-xl font-black text-white">System Logs</h2>
        <p class="text-xs text-slate-400">Chronological history of admin and order activities.</p>
    </div>

    <div class="bg-slate-950 rounded-3xl border border-slate-800 p-6 shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-300">
                <thead class="text-[11px] uppercase tracking-wider text-slate-500 bg-slate-900 border-b border-slate-800">
                    <tr>
                        <th class="p-3">Timestamp</th>
                        <th class="p-3">User / Admin</th>
                        <th class="p-3">Action</th>
                        <th class="p-3">Details</th>
                        <th class="p-3">IP Address</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60 font-medium">
                    @forelse($logs as $log)
                        <tr class="hover:bg-slate-900/50 transition">
                            <td class="p-3 text-slate-400 font-mono">{{ $log->created_at ? $log->created_at->format('Y-m-d H:i:s') : 'N/A' }}</td>
                            <td class="p-3 font-bold text-white">{{ $log->userName ?? 'System' }}</td>
                            <td class="p-3"><span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-800 text-emerald-400">{{ $log->action }}</span></td>
                            <td class="p-3 max-w-sm truncate">{{ $log->details }}</td>
                            <td class="p-3 font-mono text-slate-500">{{ $log->ipAddress ?? '127.0.0.1' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-slate-500">No activity logs recorded.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-center">
            {{ $logs->links() }}
        </div>
    </div>
</div>
@endsection
