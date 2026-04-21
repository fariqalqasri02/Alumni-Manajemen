<table border="1">
    <thead>
        <tr><th>Nama</th><th>Email</th><th>Role</th><th>Status</th></tr>
    </thead>
    <tbody>
        @foreach ($reportData['users'] as $user)
            <tr><td>{{ $user->name }}</td><td>{{ $user->email }}</td><td>{{ $user->role }}</td><td>{{ $user->user_type }}</td></tr>
        @endforeach
    </tbody>
</table>
