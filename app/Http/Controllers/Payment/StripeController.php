<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Stripe\StripeClient;
use function GuzzleHttp\Psr7\str;

/* Status Codes
PAYMENT-200 - ok
PAYMENT-201 - waiting for verification
PAYMENT-400 - error

*/

class StripeController extends Controller
{
    protected $secretKey;


    public function __construct($secretKey)
    {
        $this->secretKey = $secretKey;
        Stripe::setApiKey($this->secretKey);
    }

    public function stripeCurrencyHandler($paymentInfo)
    {
        $amount = $paymentInfo['amount'];
        $amount = (explode('.', $amount)[0]) . (explode('.', $amount)[1]);
        return $amount;
    }

    public function proceedIntentPayment($paymentInfo)
    {
        $stripe = new StripeClient(
            $this->secretKey
        );
        try {
            $amount = $this->stripeCurrencyHandler($paymentInfo);
            $trigger = $stripe->paymentIntents->create([
                'amount' => $amount,
                'currency' => $paymentInfo['currency'],
                'description' => $paymentInfo['description'],
                'payment_method' => $paymentInfo['payment_intent'],
                'confirm' => true,
            ]);
            return [
                "success" => true,
                "status" => $trigger->status == "succeeded" ? "PAYMENT-200":"PAYMENT-201",
                "payload" => [
                    'data' => $trigger->id
                ],
                "message" => "payment success"
            ];
        } catch (\Exception $e) {
            return [
                "success" => false,
                "status" => "PAYMENT-400",
                "payload" => [

                ],
                "message" => $e->getMessage()

            ];
        }
    }

    public function getPaymentIntentStatus($payment_id)
    {
        $stripe = new StripeClient(
            $this->secretKey
        );
        try {
            return $stripe->paymentIntents->retrieve(
                $payment_id
            );
        } catch (\Exception $e) {
            return "PAYMENT-404";
        }

    }

}
