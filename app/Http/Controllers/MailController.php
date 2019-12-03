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

        $key = file_get_contents("https://www.uuidgenerator.net/api/version4");
        $key=str_replace("\r\n","",$key);
        
        $currentDate = Carbon::now();
        ProductLicense::create([
            'key' => $key,
            'expiration_date' => $currentDate->addMinutes(1),
            'user_id' => $user->id,
            'product_id' => '1'
        ]);

        $mgClient = Mailgun::create(env('MAILGUN_API_KEY'));
        $mgClient->SMTPSecure = 'tls'; 
        $res = $mgClient->messages()->send(env('MAILGUN_API_DOMAIN'), [
          'from'    => 'Loja Online<'.env('MAILGUN_EMAIL').'>',
          'to'      => $user->email,
          'subject' => 'Chave Adquirida',
          'html'    => '<p>Obrigado pela sua compra.</p><p>Para ativar o produto insira a seguinte chave:</p><p><strong>' . $key . '</strong></p>',
          'o:require-tls'   => 'true'
        ]);

        if(!$res) {
            \Log::info("Email to " . $user->email . " with the key " . $key . " cannot be sent");
        } else {
            \Log::info("Email to " . $user->email . " with the key " . $key . " has been sent");
        }

        // OU

        //Mail::to($user)->send(new OrderShipped($key));

        return view('mailForm');
    }

    public function ValidateEmail($value='')
    {
        # code...
    }
}
