<?php
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

use \Payment as Pay;

class PaypalController extends BaseController
{
    private $_api_context;

    public function __construct()
    {
        // setup PayPal api context
        $paypal_conf = Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function prepare(){
        return View::make('backend.pages.prepare');
    }

    public function postPayment()
    {
        if(Input::has('email')){
            Session::put('email', Input::get('email'));
        }else{
            return Redirect::back();
        }

        $description = 'Plugin '. Session::get('email');


        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();
        $item_1->setName($description)
        ->setCurrency('USD')
        ->setQuantity(1)
        ->setPrice(Setting::key('plugin_cost')->first()->value);


        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('USD')
        ->setTotal(Setting::key('plugin_cost')->first()->value);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
        ->setItemList($item_list)
        ->setDescription($description);

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('payment.status'))
        ->setCancelUrl(URL::route('payment.status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
        ->setPayer($payer)
        ->setRedirectUrls($redirect_urls)
        ->setTransactions(array($transaction));

        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                echo "Exception: " . $ex->getMessage() . PHP_EOL;
                $err_data = json_decode($ex->getData(), true);
                exit;
            } else {
                die('Some error occur, sorry for inconvenient');
            }
        }

        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        Session::put('paypal_payment_id', $payment->getId());

        if(isset($redirect_url)) {
            return Redirect::away($redirect_url);
        }

        return Redirect::route('login')
        ->with('error', 'Unknown error occurred');
    }

    public function getPaymentStatus()
    {
        $description = 'Plugin '. Session::get('email');
        $payment_id = Session::get('paypal_payment_id');

        //Session::forget('paypal_payment_id');

        if ((!Input::has('PayerID')) || (!Input::has('token'))) {
            return Redirect::route('login')->with('alert', ['type' => 'danger', 'message' => 'Hubo un problema en el pago.']);
        }

        $payment = Payment::get($payment_id, $this->_api_context);

        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        $result = $payment->execute($execution, $this->_api_context);
        //echo '<pre>';print_r($result);echo '</pre>';exit; // DEBUG RESULT, remove it later
        if ($result->getState() == 'approved') {
            $data = [];
            $data['paymentid'] = $result->id;
            $data['token'] = Input::get('token');
            $data['payerid'] = Input::get('PayerID');
            $data['total'] = Setting::key('plugin_cost')->first()->value;
            $data['status'] = 'approved';
            $data['description'] = $description;

            $data['email'] = Session::get('email');
            $data['ip'] = Request::getClientIp();

            /* GENERATE LICENSE */

            $license['name'] = "Venta: ". $data['email'];

            $license['license'] = "<<<LICENSER".sha1(mt_rand(10000,99999).time().$license['name']).
            sha1($license['name'].time().mt_rand(10000,99999)).
            sha1($license['name'].mt_rand(10000,99999).time()).
            sha1($license['name'].time().uniqid()).
            sha1(uniqid().$license['name'].time())."LICENSER>>>";

            $license['user_id'] = User::first()->id;

            $l = new License($license);
            if ($l->save())
            {
                $data['license_id'] = $l->id;
                $p = Pay::create($data);

                if($p->save()){
                    Session::forget('paypal_payment_id');
                    Session::forget('email');
                    Session::put('payment', $p->toJson());
                    Session::put('license', $l->toJson());
                    return Redirect::route('payment.success');
                }
            }
            return Redirect::route('payment.failed');
        }
    }


    public function success()
    {
        $payment = json_decode(Session::get('payment'));
        $license = json_decode(Session::get('license'));

        return View::make('backend.pages.success', compact('payment', 'license'));
    }
}