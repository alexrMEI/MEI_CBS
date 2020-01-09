<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

use Faker\Factory as Faker;

class UserController extends Controller
{
    public function log()
    {
        $faker = Faker::create();

        foreach (range(1,10) as $index) {
            Log::channel('mailgun')->critical($faker->email . ' 1 Connection timeout.');
        }

        foreach (range(1,50) as $index) {
            Log::channel('local-auth')->warning($faker->dateTime($max = 'now', $timezone = null)->format('Y-m-d H:i:s') . ' ' . $faker->ipv4 . ' User login failed 3 times in the past 15 minutes');
            Log::channel('google-auth')->warning($faker->dateTime($max = 'now', $timezone = null)->format('Y-m-d H:i:s') . ' ' . $faker->ipv4 . ' User login failed 3 times in the past 15 minutes');
        }

        foreach (range(1,10) as $index) {
            Log::channel('local-auth')->alert($faker->dateTime($max = 'now', $timezone = null)->format('Y-m-d H:i:s') . ' ' . $faker->ipv4 . ' User login failed 120 times in the past 15 minutes');
            Log::channel('google-auth')->alert($faker->dateTime($max = 'now', $timezone = null)->format('Y-m-d H:i:s') . ' ' . $faker->ipv4 . ' User login failed 120 times in the past 15 minutes');
        }

        return response()->json('success', 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(User::all(), 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin()
    {
        $users = User::all();
        return view('admin.users.list')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->fill($request->all());
        $user->password = bcrypt($request->password);
        $user->save();
        $user->assignRole('client');

        return response(null, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user->load('roles');
        return view('admin.users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param \App\User         $user
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->fill($request->except('password'));
        $user->save();

        return response(null, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\User $user
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response(null, 200);
    }
}
