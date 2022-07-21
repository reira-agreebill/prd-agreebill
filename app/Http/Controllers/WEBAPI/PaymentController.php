<?php

namespace App\Http\Controllers\WEBAPI;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Payment\MercadopagoController;
use App\Http\Controllers\Payment\PayPalController;
use App\Http\Controllers\Payment\RazorPayController;
use App\Http\Controllers\Payment\StripeController;
use App\Models\Store;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {


        $store = Store::getStoreByViewId($request->store_id);
        $payment_credentials =  $store->getSettings;

        $user_info = $request->user_info;
        $payment_info = $request->payment_info;
        $response = array();
        if ($payment_info['gateway'] == "STRIPE") {
            $store_stripe_secret = $payment_credentials->StripeSecretKey ?? ''; // from store data
            $stripe = new StripeController($store_stripe_secret);

            $payment = array(
                "payment_intent" => $request['payment_intent_id'],
                "amount" => $payment_info['amount'],
                "currency" => $payment_info['currency'],
                "description" => $payment_info['description']
            );
            $response = $stripe->proceedIntentPayment($payment);
        } elseif ($payment_info['gateway'] == "RAZORPAY") {
            $key_id = $payment_credentials->RazorpayKeyId ?? '';
            $key_secret = $payment_credentials->RazorpayKeySecret ?? '';
            $razorpay = new RazorPayController($key_id, $key_secret);

            $response =  $razorpay->proceedPayment($request->payment_info);
            $response['payload']['customer_name'] = $user_info['name'];
            $response['payload']['customer_phone'] = $user_info['phone'];

        } else if ($payment_info['gateway'] == "PAYPAL"){

            $client_id = $payment_credentials->PaypalKeyId ?? '';
            $secret = $payment_credentials->PaypalKeySecret ?? '';
            $mode = $payment_credentials->PaypalMode ?? '';
            $paypal = new PayPalController($client_id, $secret,$mode,"V2");

            $response = $paypal->getPaymentStatus($request['order_id'],$request['payer_id']);


        }
        else if ($payment_info['gateway'] == "MERCADO_PAGO") {

            $payment  = new MercadopagoController($payment_credentials->MercadoPagoKeySecret ?? '');
            $payment_trigger_data = $request->payment_info;
            $payment_trigger_data['checkout_name'] = ucfirst($store->store_name . " checkout");
            $payment_trigger_data['back_urls'] = $request->redirect_back_url;
            $response = $payment->create_payment( $payment_trigger_data);

        }



        return response()->json([
            "success" => $response['success'],
            "status" => $response['status'],
            "payload" => [
                $response['payload']
            ],
            "message" => $response['message']
        ], 200);


    }
}
