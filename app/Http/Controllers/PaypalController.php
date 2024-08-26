<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Omnipay\Omnipay;


class PaypalController extends Controller
{
    //
    private $gateway;
    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true);
    }

    public function pay(Request $request)
    {
        try {
            $response = $this->gateway->purchase(array(
            'amount'=>$request->amount,
            'currency'=>env('PAYPAL_CURRENCY'),
            'returnUrl'=>url('success', ['invoiceId' => $request->invoceId]),
                'cancelUrl'=>url('error')
            ))->send();
            if ($response->isRedirect()){
                $response->redirect();
            }
            else{
                return $response->getMessage();
            }
        }catch (\Throwable $th){
            return $th->getMessage();
        }
    }
    public function success(Request $request, $id)
    {
        if ($request->input('paymentId') && $request->input('PayerID')){
            $transaction = $this->gateway->completePurchase(array(
                'payer_id'=>$request->input('PayerID'),
                'transactionReference' => $request->input('paymentId')
            ));
            $response = $transaction->send();

            if ($response->isSuccessful()){
                $arr= $response->getData();

                $payment = new Payment();
                $payment->invoice_id = $id;
                $payment->payment_id = $arr['id'];
                $payment->payer_id = $arr['payer']['payer_info']['payer_id'];
                $payment->payer_email = $arr['payer']['payer_info']['email'];
                $payment->amount = $arr['transactions']['0']['amount']['total'];
                $payment->currency = env('PAYPAL_CURRENCY');
                $payment->payment_status = $arr['state'];

                $payment->save();

                $successMessage = "Payment is Successful. Your Transaction Id is: " . $arr['id'];
                return view('message.success')->with('successMessage', $successMessage);
            }
            else{
                return $response->getMessage();
            }
        }
        else{
            $declinedMessage = 'Payment declined!';
            return view('message.declined')->with('declinedMessage', $declinedMessage);
        }
    }
    public function error()
    {
        $errorMessage = 'User declined the Payment!';
        return view('message.error',['errorMessage' => $errorMessage]);
    }
}
