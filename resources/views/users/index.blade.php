@extends('layouts.app')


@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <h2 class="text-2xl font-semibold text-gray-500 mb-6">User List</h2>
    <p class="text-red-600 font-bold">Logged in as: {{ Auth::user()->email }} ({{ Auth::user()->getRoleNames()->first() }})</p>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="w-full text-sm text-left text-gray-700 border-collapse border-spacing-0 rounded-lg overflow-hidden">
        <thead class="bg-gray-500 text-gray-800">
            <tr>
                <th class="py-2 px-6 border">Name</th>
                <th class="py-2 px-6 border">Email</th>
                <th class="py-2 px-6 border">Role</th>
                <th class="py-2 px-6 border text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="text-center">
                    <td class="py-2 px-6 border text-left">{{ $user->name }}</td>
                    <td class="py-2 px-6 border text-left">{{ $user->email }}</td>
                    <td class="py-2 px-6 border">{{ $user->getRoleNames()->first() ?? 'No role' }}</td>
                    <td class="py-2 px-6 border">
                        <form action="{{ route('users.updateRole', $user->id) }}" method="POST" class="flex justify-center items-center gap-2">
                            @csrf
                            @method('PUT')

                            <select name="role" class="border border-gray-300 rounded px-2 py-1 text-sm">
                                <option value="admin">admin</option>
                                <option value="manager">manager</option>
                                <option value="supervisor">supervisor</option>
                                <option value="staff">staff</option>
                                <option value="user">user</option>
                            </select>

                            <button type="submit"
                                class="bg-green-600 hover:bg-green-500 text-gray-500 text-sm px-3 py-1 rounded shadow transition">
                                Update
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    </div>
</div>
@endsection
