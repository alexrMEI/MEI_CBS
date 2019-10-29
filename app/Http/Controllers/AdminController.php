<?php

namespace App\Http\Controllers;

use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\FailedLoginAttempt;
use Illuminate\Http\Request;

class AdminController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function authentication()
    {
        $failedLogins = FailedLoginAttempt::all();
        return view('admin.siem.authentication')->with('failedLogins', $failedLogins);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function editUser(User $user)
    {
        $user->load('roles');
        $roles = Role::all();
        return view('admin.users.edit')->with(['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param \App\User         $user
     *
     * @return \Illuminate\Http\Response
     */
    public function updateUser(Request $request, User $user)
    {
        return response(null, 200);
    }
}
