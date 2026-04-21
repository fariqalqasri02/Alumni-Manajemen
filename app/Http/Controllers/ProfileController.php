<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $request->user()->loadMissing('profile');

        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $currentUserType = $request->user()->user_type ?: 'mahasiswa';

        $request->user()->fill([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'nim' => $validated['nim'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'user_type' => ($validated['user_type'] ?? null) ?: $currentUserType,
        ]);

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();
        $request->user()->profile()->updateOrCreate(
            ['user_id' => $request->user()->id],
            [
                'address' => $validated['address'] ?? null,
                'graduation_year' => $validated['graduation_year'] ?? null,
                'study_program' => $validated['study_program'] ?? null,
                'education_history' => $validated['education_history'] ?? null,
                'skills' => $validated['skills'] ?? null,
                'work_experience' => $validated['work_experience'] ?? null,
                'current_company' => $validated['current_company'] ?? null,
                'current_position' => $validated['current_position'] ?? null,
                'linkedin_url' => $validated['linkedin_url'] ?? null,
            ]
        );

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
