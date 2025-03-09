<?php

namespace App\Http\Controllers;

use App\Models\ContactSubmission;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get all users with pagination
        $users = User::latest()->paginate(10);

        $pageTitle = 'Users';

        return view('admin.users.index', compact('users', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Create User';

        return view('admin.users.create', compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|same:password',
            'is_admin' => 'required|boolean',
        ]);

        // create user
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->is_admin = $request->is_admin;
        $user->email_verified_at = now();
        $user->status = 'active';
        $user->save();

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $pageTitle = 'Edit User: '.$user->name;

        return view('admin.users.edit', compact('user', 'pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // validate request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:8',
            'password_confirmation' => 'nullable|same:password',
            'is_admin' => 'required|boolean',
            'status' => 'required|string|in:active,inactive,pending,banned',
        ]);

        // update user
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->is_admin = $request->is_admin;
        if ($request->status === 'active' && $user->status !== 'active') {
            $user->email_verified_at = now();
        }
        $user->status = $request->status;
        $user->save();

        return
            url()->previous()
            ? redirect()->back()->with('success', 'User updated successfully.')
            : redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function distributors()
    {
        $pageTitle = 'Distributors';
        $distributors = ContactSubmission::latest()->paginate();

        return view('admin.users.distributor-index', compact('distributors', 'pageTitle'));
    }
}
