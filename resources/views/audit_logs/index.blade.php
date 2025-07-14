@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <h2 class="text-2xl font-semibold text-gray-700 mb-6">Audit Logs</h2>

    <div class="bg-white shadow rounded overflow-x-auto">
        <table class="min-w-full table-auto text-sm text-left text-gray-700 border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 border">Timestamp</th>
                    <th class="px-4 py-2 border">User</th>
                    <th class="px-4 py-2 border">Action</th>
                    <th class="px-4 py-2 border">Details</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logs as $log)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-2 border">{{ $log->created_at->format('Y-m-d H:i') }}</td>
                    <td>{{ dd($log->user) }}</td>
                    <td class="px-4 py-2 border">
                        {{ $log->user ? $log->user->name : 'Unknown' }} 
                        ({{ $log->user ? $log->user->email : 'deleted user' }})
                    </td>
                    <td class="px-4 py-2 border font-medium text-blue-700">{{ $log->action }}</td>
                    <td class="px-4 py-2 border">{{ $log->details }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $logs->links() }}
        </div>
    </div>
</div>
@endsection
