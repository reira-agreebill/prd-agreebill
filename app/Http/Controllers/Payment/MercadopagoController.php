<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\StoreSetting;
use Illuminate\Http\Request;


// test token : TEST-5261646553829581-041804-0fa632494c8a4be840db2db55541286a-548770938
class MercadopagoController extends Controller
{
    protected $access_token;

    public function __construct($token)
    {
        $this->access_token = $token;
    }

    public function create_payment($paymentInfo)
    {
        try {


            \MercadoPago\SDK::setAccessToken($this->access_token);
            $preference = new \MercadoPago\Preference();
            $item = new \MercadoPago\Item();
            $item->title = $paymentInfo['checkout_name'];

            $item->quantity = 1;
            $item->unit_price = round($paymentInfo['amount']);

            $preference->items = array($item);
            $preference->back_urls = array(
                'success' => $paymentInfo['back_urls'],
            );
            $preference->auto_return = 'approved';
            $preference->save();

            return [
                "success" => true,
                "status" => "PAYMENT-202", // order create
                "payload" => $preference->toArray(),
                'message' => "order created waiting for payment"
            ];
        } catch (\Exception $e) {
            $response = [
                "success" => false,
                "status" => "PAYMENT-400",

                "payload" => [
                    'data' => []
                ],
                'message' => "Payment Error",
            ];
        }
        return response()->json($response);
    }
}
