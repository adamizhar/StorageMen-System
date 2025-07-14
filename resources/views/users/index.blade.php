@extends('layouts.app')


@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <h2 class="text-2xl font-semibold text-gray-500 mb-6">User List</h2>
    <p class="text-red-600 font-bold">Logged in as: {{ Auth::user()->email }} ({{ Auth::user()->role }})</p>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="w-full text-sm text-left text-gray-700 border-collapse border-spacing-0 rounded-lg overflow-hidden">
            <thead class="bg-gray-500 text-gray-800">
                <tr>
                    <th class="py-2 px-6 border">Name</th>
                    <th class="py-2 px-6 border">Email</th>
                    <th class="py-2 px-6 border">Role</th>
                    <th class="py-2 px-6 border">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr class="hover:bg-blue-50">
                    <td class="py-2 px-4 border">{{ $user->name }}</td>
                    <td class="py-2 px-4 border">{{ $user->email }}</td>
                    <td class="py-2 px-4 border">{{ ucfirst($user->role) }}</td>

                    {{-- ✅ This is the ACTION column --}}
                    <td class="py-2 px-4 border">
                        @if (Auth::user()->role === 'admin')
                            <form action="{{ route('users.updateRole', $user->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="flex flex-row items-center flex items-center space-x-8">
                                    <select name="role" class="w-48 border rounded px-3 py-2 pr-8 text-center appearance-none">
                                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                        <option value="manager" {{ $user->role === 'manager' ? 'selected' : '' }}>Manager</option>
                                        <option value="supervisor" {{ $user->role === 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                                        <option value="staff" {{ $user->role === 'staff' ? 'selected' : '' }}>Staff</option>
                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                    </select>

                                    <button type="submit"
                                        style="background-color: #16a34a; color: white;"
                                        class="font-semibold px-4 py-2 rounded shadow hover:opacity-90">
                                        Update
                                    </button>
                                </div>

                            </form>
                        @else
                            <span class="text-center text-sm">{{ ucfirst($user->role) }}</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection
