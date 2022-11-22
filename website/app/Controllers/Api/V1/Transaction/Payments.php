<?php

namespace App\Controllers\Api\V1\Transaction;

use App\Models\PaymentModel;
use App\Controllers\Api\V1\BaseResponse;

class Payments extends BaseResponse
{
    public function index()
    {
        helper('jwt');
        $user = getUserFromToken($this->request->getServer('HTTP_AUTHORIZATION'));
        if(!$user)
            return $this->response("Kesalahan pada database!", null, 500); 
        
        $model = new PaymentModel();
        return $this->response("Berhasil Mendapatkan data!", $model->getPaymentMethods(), 200); 
    }

    // public function getPayment()
    // {
    //     helper('jwt');
    //     $user = getUserFromToken($this->request->getServer('HTTP_AUTHORIZATION'));
        
    //     $options = [
    //         'baseURI' => 'https://sandbox.duitku.com',
    //         'timeout' => 3,
    //     ]; 
    //     $dt = date("Y-m-d 18:i:s");
    //     //return $this->response("Berhasil Mendapatkan data!", $dt, 200); 
    //     $client = \Config\Services::curlrequest($options);
    //     $response = $client->request('POST', '/webapi/api/merchant/paymentmethod/getpaymentmethod', ['json' => 
    //             [
    //                 'merchantcode' => getenv("MERCHANT_CODE"),
    //                 'amount' => '25000',
    //                 'datetime' => $dt,
    //                 'signature' => hash("sha256", getenv("MERCHANT_CODE")."25000".$dt.getenv("DUITKU_APIKEY"))
    //             ]
    //         ]);
    //     $json = json_decode($response->getBody(), true)['paymentFee'];
    //     $model = new PaymentModel();
    //     foreach($json as $p){
    //         $model->savePayment($p);
    //     }
    //     return $this->response("Berhasil Mendapatkan data!", $json, 200); 
    // }
}