<?php

namespace App\Controllers\Api\V1\Transaction;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;


use App\Models\PaymentModel;
use App\Controllers\Api\V1\BaseResponse;

class Checkout extends BaseResponse
{
    private $user = null;
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->user = getUserFromToken($this->request->getServer('HTTP_AUTHORIZATION'));
    }


    public function index()
    {
        if(!$this->user)
            return $this->response("Kesalahan pada database!", null, 500); 
        

        $options = [
            'baseURI' => 'https://sandbox.duitku.com',
            'timeout' => 3,
        ];    
        $client = \Config\Services::curlrequest($options);
        try {
            $response = $client->request('POST', '/webapi/api/merchant/v2/inquiry', ['json' => 
                [
                    'merchantCode' => 'DS13871',
                    'paymentAmount' => 20000,
                    'paymentMethod' => 'VA',
                    'merchantOrderId' => '1667129832694',
                    'productDetails' => 'Pembayaran untuk sesi konsultasi dengan Dr. Akmal MF',
                    'customerVaName' => 'Ujang Surya',
                    'email' => 'akmalmf007@gmail.com',
                    'phoneNumber' => '082115262249',
                    'itemDetails' => [["name" => "1 Sesi konsultasi dengan Dr. Akmal MF", 'price' => 20000, "quantity"=>1]],
                    'callbackUrl' => 'http://akmalmf.id/callback',
                    'returnUrl' => 'http://akmalmf.id/return',
                    'expiryPeriod' => '30',
                    'signature' => md5(getenv("MERCHANT_CODE")."1667129832694"."200200".getenv("DUITKU_APIKEY"))
                ]
            ]);

            
        } catch (\Exception $e) {
            return $this->response("Kesalahan pada payment gateway!", $e->getMessage(), 500); 
        }
    }
}