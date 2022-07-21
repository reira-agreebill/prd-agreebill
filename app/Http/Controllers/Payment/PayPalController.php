<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Symfony\Component\Console\Input\Input;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;

class PayPalController extends Controller
{
    protected $secret;
    protected $client_id;
    protected $mode;
    protected $version;

    protected $environment;
    protected $client;

    protected $message;
    protected $response_status;
    protected $payload;
    protected $success;


    public function __construct($CLIENT_ID, $SECRET, $MODE, $VERSION) // v1
    {
        $this->secret = $SECRET;
        $this->client_id = $CLIENT_ID;
        $this->mode = $MODE;
        $this->version = $VERSION;

        if ($VERSION == "V1") {
            $this->_api_context = new ApiContext(new OAuthTokenCredential($CLIENT_ID, $SECRET)
            );
            $this->_api_context->setConfig(array(
                'mode' => 'sandbox' ?? $MODE,//
                'http.ConnectionTimeOut' => 30,
                'log.LogEnabled' => true,
                'log.FileName' => storage_path() . '/logs/paypal.log',
                'log.LogLevel' => 'ERROR'
            ));
        } else {
            $this->environment = new SandboxEnvironment($this->client_id, $this->secret);
            $this->client = new PayPalHttpClient($this->environment);
        }
    }


    public function getPaymentStatus($payment_id, $payer_id)
    {

        if ($this->version == "V1") {
            try {
                $payment = Payment::get($payment_id, $this->_api_context);
                $execution = new PaymentExecution();
                $execution->setPayerId($payer_id);
                $result = $payment->execute($execution, $this->_api_context);

            } catch (\Exception $e) {

                $this->success = false;
                $this->response_status = "PAYMENT-400";
                $this->payload = [];
                $this->message = $e->getMessage();

            }
            if ($result->getState() == 'approved') {


                $this->success = true;
                $this->response_status = "PAYMENT-200";
                $this->payload = [];
                $this->message = "Payment Success";


            } else {
                $this->success = false;
                $this->response_status = "PAYMENT-400";
                $this->payload = [];
                $this->message = $result->getMessage();
            }

        } else {
            $request = new OrdersGetRequest($payment_id);

            try {

                $response = $this->client->execute($request);


                $data = response()->json($response->result);


                if ($data->getData('status')['status'] == 'COMPLETED') {

                    $this->success = true;
                    $this->response_status = "PAYMENT-200";
                    $this->payload = [];
                    $this->message = "Payment Success";


                } else {
                    $this->success = false;
                    $this->response_status = "PAYMENT-400";
                    $this->payload = [];
                    $this->message = "Payment Failed";
                }

            } catch (HttpException $ex) {
                $this->success = false;
                $this->response_status = "PAYMENT-400";
                $this->payload = [];
                $this->message = "Payment Failed";
            }
        }

        return [
            "success" => $this->success,
            "status" => $this->response_status,
            "payload" => $this->payload,
            "message" => $this->message
        ];
    }

}

