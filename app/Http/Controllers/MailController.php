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
use App\ProductLicense;
use Carbon\Carbon;

//require 'PHPMailerAutoload.php';

require '../vendor/autoload.php';
use Mailgun\Mailgun;

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

        /* --- Upgrade needed to use this ---
        # Validate Email
        $mgClient = new Mailgun('pubkey-f2ec547890fcf46e4bd6a253f926f8b5'); // try Private Key
        $validateAddress = 'foo@mailgun.net';

        # Issue the call to the client.
        $result = $mgClient->get("address/validate", array('address' => $validateAddress));
        # is_valid is 0 or 1
        $isValid = $result->http_response_body->is_valid;
        */

        // Check if Mail was deliveres with success
        //$mgClient = new Mailgun('pubkey-f2ec547890fcf46e4bd6a253f926f8b5');
        /*$mgClient = Mailgun::create('pubkey-f2ec547890fcf46e4bd6a253f926f8b5', 'https://api.eu.mailgun.net');
        $domain = env('MAILGUN_DOMAIN');
        $queryString = array(
            'begin'        => 'Fri, 3 May 2013 09:00:00 -0000',
            'ascending'    => 'yes',
            'limit'        =>  25,
            'pretty'       => 'yes'
        );

        # Make the call to the client.
        $result = $mgClient->get("$domain/events", $queryString);
        dd($result);*/

        $key = file_get_contents("https://www.uuidgenerator.net/api/version4");
        
        $currentDate = Carbon::now();
        ProductLicense::create([
            'key' => $key,
            'expiration_date' => $currentDate->addMinutes(1),
            'user_id' => $user->id,
            'product_id' => '1'
        ]);

        $mgClient = Mailgun::create(env('MAILGUN_API_KEY'));
        $mgClient->SMTPSecure = 'tls'; 
        $mgClient->messages()->send(env('MAILGUN_API_DOMAIN'), [
          'from'    => 'Loja Online<'.env('MAILGUN_EMAIL').'>',
          'to'      => $user->email,
          'subject' => 'Chave Adquirida',
          'html'    => '<p>Obrigado pela sua compra.</p><p>Para ativar o produto insira a seguinte chave:</p><p><strong>' . $key . '</strong></p>',
          'o:require-tls'   => 'true'
        ]);

        // OU

        //Mail::to($user)->send(new OrderShipped($key));

        return view('mailForm');
    }

    public function ValidateEmail($value='')
    {
        # code...
    }
}
