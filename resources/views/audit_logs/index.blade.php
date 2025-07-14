@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <h2 class="text-2xl font-semibold text-gray-500 mb-6">Audit Logs</h2>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="w-full text-sm text-left text-gray-700 border-collapse rounded-lg overflow-hidden">
            <thead class="bg-gray-800 text-white rounded-lg">
                <tr class="text-xs font-semibold uppercase tracking-wider text-gray-600">
                    <th class="px-4 py-2 border">Timestamp</th>
                    <th class="px-4 py-2 border">User</th>
                    <th class="px-4 py-2 border">Action</th>
                    <th class="px-4 py-2 border">Details</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-2 border">{{ $log->created_at->format('Y-m-d H:i') }}</td>
                    <td class="px-4 py-2 border">
                        @if ($log->user)
                            <strong>{{ $log->user->name }}</strong><br>
                            <span class="text-xs text-gray-500">{{ $log->user->email }}</span>
                        @else
                            <span class="text-red-500 italic">Deleted user</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 border text-blue-700 font-medium">{{ $log->action }}</td>
                    <td class="px-4 py-2 border text-gray-600">{{ $log->details }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-4 text-center text-gray-500">No audit logs found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $logs->links() }}
        </div>
    </div>
</div>
@endsection
