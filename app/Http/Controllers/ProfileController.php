<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(string $id)
    {
        $users = User::find($id);
        return view('users.edit', compact('users'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'fullname' => 'required',
            'email' => 'required',
            'address' => 'required',
          ]);

          User::find($id)->update($validatedData);

          return redirect()->route('dashboard');
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
