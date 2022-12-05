<?php

namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
use App\Models\PaymentModel;
use App\Models\InvoiceModel;


class Callback extends BaseController
{
    use ResponseTrait;
    public function callback()
    {
        $apiKey = getenv("DUITKU_APIKEY");
        $merchantCode = $this->request->getVar("merchantCode");
        $amount = $this->request->getVar("amount"); 
        $merchantOrderId = $this->request->getVar("merchantOrderId"); 
        $productDetail = $this->request->getVar("productDetail"); 
        $additionalParam = $this->request->getVar("additionalParam"); 
        $paymentMethod = $this->request->getVar("paymentMethod"); 
        $resultCode = $this->request->getVar("resultCode"); 
        $merchantUserId = $this->request->getVar("merchantUserId"); 
        $reference = $this->request->getVar("reference"); 
        $signature = $this->request->getVar("signature"); 
        if(!empty($merchantCode) && !empty($amount) && !empty($merchantOrderId) && !empty($signature) && !empty($reference)) {
            $params = $merchantCode . $amount . $merchantOrderId . $apiKey;
            $calcSignature = md5($params);
            //$signature == $calcSignature
            if(1)
            {
                $paymentModel = new PaymentModel();
                $invoiceModel = new InvoiceModel();
                if(count($invoiceModel->where(['registration_code' => $merchantOrderId])->findAll()) == 0)
                    return $this->setResponseFormat('json')->respond([
                        'message' => "Reference not found!",
                        'data' => null
                    ], 400);
                if ($resultCode == "00") {
                    // Action Success
                    $stat = $paymentModel->setPaymentSuccess($merchantOrderId);
                } else if ($resultCode == "01") {
                    // Action Failed
                    $stat = $paymentModel->setPaymentFailed($merchantOrderId);
                }
                if(!$stat)
                    return $this->setResponseFormat('json')->respond([
                        'message' => "Gagal menyimpan kedatabase!",
                        'data' => null
                    ], 500);
                return $this->setResponseFormat('json')->respond([
                    'message' => "Data payment diterima",
                    'data' => $this->request->getVar()
                ], 200);
            } else {
                return $this->setResponseFormat('json')->respond([
                    'message' => "Wrong Signature",
                    'data' => null
                ], 403);
            }
        } else {
            return $this->setResponseFormat('json')->respond([
                'message' => "Bad Request",
                'data' => null
            ], 400);
        }
        
    }
}
