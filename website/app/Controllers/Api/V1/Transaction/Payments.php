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
}