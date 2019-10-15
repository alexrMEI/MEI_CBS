<?php

namespace App\Http\Controllers;

use drupol\Yaroc\Plugin\Provider;
use drupol\Yaroc\RandomOrgAPI;

use Illuminate\Http\Request;
use App\User;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth;

class MailController extends Controller
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
        //Mail::to("riky.rod@hotmail.com")->send(new OrderShipped);
        $user = \Auth::user();
        Mail::to($user)->send(new OrderShipped);

        $generateUUID = (new Provider())->withResource('generateUUIDs')
    ->withParameters(['n' => 1]);

        $result = (new RandomOrgAPI())
    ->withApiKey('d5b72aac-bebe-43ce-bff5-eb2a6e204ef9')
    ->getData($generateUUID);

    //dd($result);

        return view('mailForm');
    }
}
