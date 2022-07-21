<?php

namespace App\Http\Controllers\Debug;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Payment\MercadopagoController;
use App\Http\Controllers\Payment\StripeController;
use App\Models\Store;
use App\Product;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Stripe\File;
use Checkout\CheckoutApi;
use Checkout\Models\Tokens\Card;
use Checkout\Models\Payments\TokenSource;
use Checkout\Models\Payments\Payment;

class DebugController extends Controller
{
    public function test()
    {
        $config = array(
            'payeeAlias' => "1231181189",
            'host' => "https://mss.cpc.getswish.net/swish-cpcapi",
            'qrHost ' => "https://mpc.getswish.net/qrg-swish",
            'cert' => env('APP_URL') . 'ssl/Swish_Merchant_TestCertificate_1234679304.pem',
            'key' => env('APP_URL') . 'ssl/Swish_Merchant_TestCertificate_1234679304.key',
            'ca' => env('APP_URL') . 'ssl/Swish_TLS_RootCA.pem',
            'passphrase ' => "swish"
        );

        $json = array(
            "payeePaymentReference" => "0123456789",
            "callbackUrl" => "https://webhook.site/a8f9b5c2-f2da-4bb8-8181-fcb84a6659ea",
            'payerAlias' => $config['payeeAlias'],
            "amount" => 100,
            "currency " => "SEK",
            "message" => "sdd"
        );

//        return file_get_contents( public_path().'/ssl/Swish_Merchant_TestCertificate_1234679304.key',"r");
//        $cert = fopen(public_path().'/ssl/Swish_Merchant_TestCertificate_1234679304.pem','r');
//        $key = fopen( public_path().'/ssl/Swish_Merchant_TestCertificate_1234679304.key','r');
//        $ca = fopen(public_path().'/ssl/Swish_TLS_RootCA.pem','r');

//
//        $client =  Http::withHeaders([
//            'cert' => file_get_contents(public_path().'/ssl/Swish_Merchant_TestCertificate_1234679304.pem'),
//            'key'=>  file_get_contents( public_path().'/ssl/Swish_Merchant_TestCertificate_1234679304.key'),
//            'ca'=>  file_get_contents(public_path().'/ssl/Swish_TLS_RootCA.pem'),
//            'passphrase '=> "swish",
//            'content-type'=> 'application/json'
//        ])->post("{$config['host']}", $json);

//        $client = new Client(['base_uri' => "{$config['host']}"]);
//
//        $client->request('PUT', '/api/v1/paymentrequests', [
//            'curl' => [
//
//                CURLOPT_POST => 1,
//                CURLOPT_SSL_VERIFYHOST=> '1',
//                CURLOPT_SSL_VERIFYPEER =>"1"
//
//
//
//            ],
//            'headers' => [
//                'cert' => file_get_contents(public_path().'/ssl/Swish_Merchant_TestCertificate_1234679304.pem'),
//            'key'=>  file_get_contents( public_path().'/ssl/Swish_Merchant_TestCertificate_1234679304.key'),
//            'ca'=>  file_get_contents(public_path().'/ssl/Swish_TLS_RootCA.pem'),
//            'passphrase '=> "swish",
//            'content-type'=> 'application/json'
//            ],
//            'form_params'=> [
//                "payeePaymentReference" => "0123456789",
//                "callbackUrl"=> "https://webhook.site/a8f9b5c2-f2da-4bb8-8181-fcb84a6659ea",
//                'payerAlias' => $config['payeeAlias'],
//                "amount"=> 100,
//                "currency "=> "SEK",
//                "message" => "sdd"
//            ]
//        ]);
//
//        return 1;

        $ch = curl_init('https://mss.cpc.getswish.net/swish-cpcapi/api/v1/paymentrequests');
//        curl_setopt($ch, CURLOPT_POST, 1);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, '1');
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, '1');
        curl_setopt($ch, CURLOPT_CAINFO, public_path() . '/ssl/Swish_TLS_RootCA.pem');
        curl_setopt($ch, CURLOPT_SSLCERT, public_path() . '/ssl/Swish_Merchant_TestCertificate_1234679304.pem');
        curl_setopt($ch, CURLOPT_SSLKEY, public_path() . '/ssl/Swish_Merchant_TestCertificate_1234679304.key');

        curl_setopt($ch, CURLOPT_HEADERFUNCTION,
            function ($curl, $header) use (&$headers) {
                // this function is called by curl for each header received
                $len = strlen($header);
                $header = explode(':', $header, 2);
                if (count($header) < 2) {
                    // ignore invalid headers
                    return $len;
                }

                $name = strtolower(trim($header[0]));
                echo "[" . $name . "] => " . $header[1];

                return $len;
            }
        );

        $data = array("payeePaymentReference" => "0123456789", "callbackUrl" => "https://example.com/api/swishcb/paymentrequests", "payerAlias" => "4671234768", "payeeAlias" => "1231181189", "amount" => "100", "currency" => "SEK", "message" => "Kingston USB Flash Drive 8 GB");
        $data_string = json_encode($data);
        return $data;

        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'passphrase:swish',
                'Content-Length: ' . strlen($data_string))
        );

        if (!$response = curl_exec($ch)) {
            trigger_error(curl_error($ch));
        }
        curl_close($ch);


    }

    public function payment_test()
    {

//        try {
//            $secretKey = 'sk_test_46664f04-25b7-4284-a79b-170d5aac8d26';
//
//// Initialize the Checkout API in Sandbox mode. Use new CheckoutApi($liveSecretKey, false); for production
//            $checkout = new CheckoutApi($secretKey, true);
//
//
//// Create a payment method instance with card details
//            $method = new TokenSource('card');
//
//// Prepare the payment parameters
//            $payment = new Payment($method, 'GBP');
//            $payment->amount = 1000; // = 10.00
//
//// Send the request and retrieve the response
//            $response = $checkout->payments()->request($payment);
//            return  $response ;
//        }catch (\Exception $e){
//            return $e->getMessage();
//        }
        $json = array(
            "amount" => 100,
            "currency " => "JOD",
            "message" => "sdd",
            "billing" => "",
            "success_url" => "https://example.com/payments/success",
            "cancel_url" => "https://example.com/payments/cancel",
            "failure_url" => "https://example.com/payments/failure",
        );
        $client = Http::withHeaders([
            'Authorization' => "sk_test_ef1a842f-a740-48c0-90b7-6854ec417a8a",
            'Content-Type'=> "application/json"
        ])->post("https://api.sandbox.checkout.com/hosted-payments", [
            "amount" => 100,
            "currency" => "GBP",
            "message" => "sdd",
            "billing" => array(
                "address" => ["address_line1" => "11111",
                    "city" => "London",
                    "state" => "London",
                    "zip" => "W1T 4TJ",
                    "country" => "GB"
                ]),
            "success_url" => "http://127.0.0.1:8000/",
            "cancel_url" => "http://127.0.0.1:8000/",
            "failure_url" => "http://127.0.0.1:8000/"]);
        return $client;
    }
    public function payment_test_status()
    {
        $preference = \MercadoPago\SDK::setAccessToken('TEST-5261646553829581-041804-0fa632494c8a4be840db2db55541286a-548770938');
        $preference = new \MercadoPago\Payment();
        return response()->json($preference->s);
    }


}
