<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Manajemen Hak Akses</h2>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-7xl space-y-4 sm:px-6 lg:px-8">
            <form method="GET" class="rounded-2xl bg-white p-6 shadow-sm">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, email, NIM" class="w-full rounded-lg border-slate-300">
            </form>
            @foreach ($users as $user)
                <form method="POST" action="{{ route('admin.users.update', $user) }}" class="grid gap-4 rounded-2xl bg-white p-6 shadow-sm md:grid-cols-5">
                    @csrf
                    @method('PUT')
                    <div class="md:col-span-2">
                        <p class="font-semibold text-slate-900">{{ $user->name }}</p>
                        <p class="text-sm text-slate-500">{{ $user->email }} • {{ $user->nim ?: 'Tanpa NIM' }}</p>
                    </div>
                    <select name="role" class="rounded-lg border-slate-300">
                        <option value="user" @selected($user->role === 'user')>User</option>
                        <option value="admin" @selected($user->role === 'admin')>Admin</option>
                    </select>
                    <select name="user_type" class="rounded-lg border-slate-300">
                        <option value="mahasiswa" @selected($user->user_type === 'mahasiswa')>Mahasiswa</option>
                        <option value="alumni" @selected($user->user_type === 'alumni')>Alumni</option>
                    </select>
                    <button class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white">Simpan Akses</button>
                </form>
            @endforeach
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>
