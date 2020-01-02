<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Input;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\WebProfile;
use PayPal\Api\ItemList;
use PayPal\Api\InputFields;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use Session;
use URL;
use App\Order;
use App\Suborder;
use Str;
Use Request;
use Auth;
use Config;

class PaypalController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        $paypalConfig = Config::get('paypal');
        $this->apiContext = new ApiContext(new OAuthTokenCredential(
                $paypalConfig['client_id'],
                $paypalConfig['secret'])
        );
        $this->apiContext->setConfig($paypalConfig['settings']);
    }

    public function index()
    {
        return view('products');
    }

    public function payWithpaypal(Request $request)
    {

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->status = 'initialised';
        $order->save();

        Session::put('orderId', $order->getKey());

        $items = [];
        foreach (Cart::content() as $item) {
            $items[] = (new Item())
                ->setName($item->name)
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice($item->price);
        }

        $itemList = new ItemList();
        $itemList->setItems($items);

        $inputFields = new InputFields();
        $inputFields->setAllowNote(true)
            ->setNoShipping(1)
            ->setAddressOverride(0);

        $webProfile = new WebProfile();
        $webProfile->setName(uniqid())
            ->setInputFields($inputFields)
            ->setTemporary(true);
        $createProfile = $webProfile->create($this->apiContext);

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal(Cart::subtotal());

        $transaction = new Transaction();
        $transaction->setAmount($amount);
        $transaction->setItemList($itemList)
            ->setDescription('Your transaction description');

        $redirectURLs = new RedirectUrls();
        $redirectURLs->setReturnUrl(URL::to('status'))
            ->setCancelUrl(URL::to('status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectURLs)
            ->setTransactions(array($transaction));
        $payment->setExperienceProfileId($createProfile->getId());
        $payment->create($this->apiContext);

        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirectURL = $link->getHref();
                break;
            }
        }

        Session::put('paypalPaymentId', $payment->getId());
        if (isset($redirectURL)) {
            return Redirect::away($redirectURL);
        }

        Session::put('error', 'There was a problem processing your payment. Please contact support.');

        return Redirect::to('/home');
    }

    public function getPaymentStatus()
    {
        $paymentId = Session::get('paypalPaymentId');
        $orderId = Session::get('orderId');

        Session::forget('paypalPaymentId');

        if (empty(Request::get('PayerID')) || empty(Request::get('token'))) {
            Session::put('error', 'There was a problem processing your payment. Please contact support.');
            return Redirect::to('/home');
        }

        $payment = Payment::get($paymentId, $this->apiContext);
        $execution = new PaymentExecution();
        $execution->setPayerId(Request::get('PayerID'));
        $result = $payment->execute($execution, $this->apiContext);

        $order = Order::find($orderId);
        $order->status = 'processing';

        if ($result->getState() == 'approved') {
            $order->price = $result->transactions[0]->getAmount()->getTotal();
            $order->currency = $result->transactions[0]->getAmount()->getCurrency();
            $order->customer_email = $result->getPayer()->getPayerInfo()->getEmail();
            $order->customer_id = $result->getPayer()->getPayerInfo()->getPayerId();
            $order->country_code = $result->getPayer()->getPayerInfo()->getCountryCode();
            $order->payment_id = $result->getId();
            $order->payment_status = 'approved';
            $order->status = 'ok';
            $order->save();

            foreach (Cart::content() as $item) {
                $suborder = new Suborder();
                $suborder->order_id = $orderId;
                $suborder->product_id = $item->id;
                $suborder->save();
            }

            Cart::destroy();
            Session::put('success', 'Your payment was successful. Thank you.');

            return Redirect::to('/home');
        }

        Session::put('error', 'There was a problem processing your payment. Please contact support.');
        return Redirect::to('/home');
    }
}
