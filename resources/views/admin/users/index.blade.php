@extends('layouts.admin.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-2xl shadow-lg">
            <div class="p-6">
                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-3xl font-bold text-gray-800">Team Members</h1>
                    <div class="bg-indigo-50 rounded-full px-4 py-2">
                        <span class="text-indigo-700 font-medium">{{ $users->count() }} Members</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($users as $user)
                        @if($user->id !== auth()->id())
                        <div class="bg-gray-50 rounded-xl p-6 transition-all hover:shadow-md">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-3">
                                    <div class="h-12 w-12 rounded-full bg-indigo-100 flex items-center justify-center">
                                <span class="text-xl font-semibold text-indigo-700">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </span>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800">{{ $user->name }}</h3>
                                        <p class="text-sm text-gray-500">{{ $user->email }}</p>
                                    </div>
                                </div>

                                <button
                                    onclick="deleteUser('{{ $user->id }}')"
                                    class="text-red-500 hover:text-red-700 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>

                            <form action="{{ route('admin.users.role', $user->id) }}" method="POST" class="flex gap-2">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <button type="submit" name="role" value="user"
                                        class="flex-1 py-2 px-4 rounded-lg text-sm font-medium transition-all
        {{ $user->role === 'user' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                                    User
                                </button>
                                <button type="submit" name="role" value="agent"
                                        class="flex-1 py-2 px-4 rounded-lg text-sm font-medium transition-all
        {{ $user->role === 'agent' ? 'bg-purple-100 text-purple-700' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                                    Agent
                                </button>
                                <button type="submit" name="role" value="admin"
                                        class="flex-1 py-2 px-4 rounded-lg text-sm font-medium transition-all
        {{ $user->role === 'admin' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                                    Admin
                                </button>
                            </form>

                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function updateRole(userId, role) {
                fetch(`/admin/users/${userId}/update-role`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        role: role
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.message) {
                            // Show success message and reload page
                            alert(data.message);
                            window.location.reload();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Failed to update role');
                    });
            }

            function deleteUser(userId) {
                if (!confirm('Are you sure you want to delete this user?')) {
                    return;
                }

                fetch(`/admin/users/${userId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.message) {
                            alert(data.message);
                            window.location.reload();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Failed to delete user');
                    });
            }
        </script>
    @endpush
@endsection
