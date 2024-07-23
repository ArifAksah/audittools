<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display the list of users.
     */
    public function index(): View
    {
        $users = User::all();
        return view('showusers', compact('users'));
    }
    public function showUsers(): View
    {
        $users = User::all();
        return view('profile.add', compact('users'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request, $id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.index')->with('status', 'Profile updated successfully');
    }
    public function updateUser(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
            'sap' => ['required', 'string'],
            'jabatan' => ['required', 'string'],
        ]);
    
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'sap' => $request->sap,
            'jabatan' => $request->jabatan,
            'bidang' => $request->bidang,
            'inisial' => $request->inisial,
        ]);
    
        return redirect()->back()->with('status', 'Data pengguna berhasil di perbarui');
    }
    
        public function deleteUser($id): RedirectResponse
        {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->back()->with('status', 'User deleted successfully');
        }

    /**
     * Show the form for adding a new profile.
     */
    public function add(): View
    {
        $users = User::all();
        return view('profile.add',compact('users'));
    }

    /**
     * Store a newly created profile.
     */
    public function store(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed'],
            'sap' => ['required', 'string'],
            'jabatan' => ['required', 'string'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'sap' => $request->sap,
            'jabatan' => $request->jabatan,
            'bidang' => $request->bidang,
            'inisial' => $request->inisial,
        ]);

        return redirect()->back()->with('status', 'Pengguna baru berhasil ditambahkan!');
    }

    /**
     * Delete a user's account.
     */
    public function destroy($id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $user->delete();

        return Redirect::route('profile.index')->with('status', 'pengguna berhasil dihapus');
    }
}
