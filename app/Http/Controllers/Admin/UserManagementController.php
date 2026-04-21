<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index(Request $request): View
    {
        $users = User::with('profile')
            ->when($request->string('search')->toString(), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('nim', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'role' => ['required', 'in:admin,user'],
            'user_type' => ['required', 'in:mahasiswa,alumni'],
        ]);

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('status', 'Hak akses pengguna berhasil diperbarui.');
    }
}
