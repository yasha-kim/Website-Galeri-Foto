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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();
        return view('users', compact('users'));
    }

    /**
     * Display the user's profile form.
     */
    public function edit(string $id)
    {
        $users = User::findOrFail($id);
        return view('profile.edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'fullname' => 'required',
            'email' => 'required|unique:users,email,' . Auth::user()->id,
            'address' => 'required',
        ]);

        $data = $request->only(['name', 'fullname', 'email', 'address']);

        // Check if the password is provided and update it
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        Auth::user()->update($data);

        return redirect()->back()
            ->with('success', 'User updated successfully');
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
