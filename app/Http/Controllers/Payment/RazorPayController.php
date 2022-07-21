<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Str;
use Razorpay\Api\Api;

/* Status Codes
PAYMENT-200 - ok
PAYMENT-201 - waiting for verification
PAYMENT-202 - order created
PAYMENT-400 - error

*/

class RazorPayController extends Controller
{
    protected $keyId;
    protected $keySecret;

    public function __construct($keyId, $keySecret)
    {
     $this->keyId = $keyId;
     $this->keySecret = $keySecret;
    }
    public function proceedPayment($paymentInfo){
        $api = new Api($this->keyId, $this->keySecret);
        $receiptId = Str::random(20);
        try {

            $response = $api->order->create(array(
                    'receipt' => $receiptId,
                    'amount' => doubleval($paymentInfo['amount']) * 100,
                    'currency' => strtoupper($paymentInfo['currency'])
                )
            );


           return [
               "success" => true,
                "status" => "PAYMENT-202", // order create
               "payload" => [
                'orderId' => $response['id'],
                'razorpayId' => $this->keyId,
                'amount' => doubleval($paymentInfo['amount']) * 100,
                'currency' => strtoupper($paymentInfo['currency'])
                ],
               'message' => "order created waiting for payment"
            ];
        } catch (\Throwable $th) {
            $response = [
                "success" => false,
                "status" => "PAYMENT-400",

                "payload" => [
                    'data' => []
                ],
                'message' => $th->getMessage(),
            ];
            return response()->json($response);
        }


    }
}
