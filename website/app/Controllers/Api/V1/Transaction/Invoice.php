<?php

namespace App\Controllers\Api\V1\Transaction;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\InvoiceModel;
use App\Models\ReviewModel;
use App\Models\DokterModel;
use App\Models\PaymentModel;
use App\Controllers\Api\V1\BaseResponse;

class Invoice extends BaseResponse
{
    private $user = null;
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        if(strtolower(getenv("ON_TESTING")) == "true" && $this->request->getVar('test_token')){
            $this->user = getUserFromToken($this->request->getVar('test_token'));
        } else {
            $this->user = getUserFromToken($this->request->getServer('HTTP_AUTHORIZATION'));
        }
        
    }

    public function index()
    {
        if(!$this->user)
            return $this->response("Kesalahan pada database!", null, 500); 
        $invoiceModel = new InvoiceModel();
        return $this->response("Berhasil Mendapatkan data!", $invoiceModel->getInvoiceUser($this->user['id'], 0), 200); 
    }

    public function detail($id = 0)
    {
        if(!$this->user)
            return $this->response("Kesalahan pada database!", null, 500); 
        $invoiceModel = new InvoiceModel();
        $invoice = $invoiceModel->getInvoice($id, $this->user['id']);
        if(!$invoice)
            return $this->response("Dokter tidak tersedia!", null, 404);
        return $this->response("Berhasil Mendapatkan data!", $invoice, 200); 
    }

    public function check_out()
    {
        if(!$this->user)
            return $this->response("Kesalahan pada database!", null, 500);
        
        helper(['form']);
        $rules = [
            'dokter_id' => 'required|is_not_unique[dokter.id]',
            'payment_method' => 'required|is_not_unique[payment_methods.code]',
            'time' => 'required'
        ];
        if(!$this->validate($rules))
            return $this->response("Harap isi formulir dengan benar!", null, 422, $this->validator->getErrors());
        
        
        $dokterModel = new DokterModel();  
        $dokter = $dokterModel->where(['id' => $this->request->getVar("dokter_id")])->first();
        $options = [
            'baseURI' => 'https://sandbox.duitku.com',
            'timeout' => 3,
        ];    
        $client = \Config\Services::curlrequest($options);
        $invoiceModel = new InvoiceModel();
        $paymentModel = new PaymentModel();
        $paymentId = $paymentModel->getPaymentId($this->request->getVar("payment_method"));
        helper('invoice');
        $orderId = createRegistrationCode();
        try {
            $response = $client->request('POST', '/webapi/api/merchant/v2/inquiry', ['json' => 
                [
                    'merchantCode' => getenv("MERCHANT_CODE"),
                    'paymentAmount' => $dokter['price'],
                    'paymentMethod' => $this->request->getVar("payment_method"),
                    'merchantOrderId' => $orderId,
                    'productDetails' => 'Pembayaran untuk berobat dengan '.$dokter['nama'],
                    'customerVaName' => $this->user['fullname'],
                    'email' => $this->user['email'],
                    'itemDetails' => [["name" => "1 Sesi konsultasi dengan ".$dokter['nama'], 'price' => $dokter['price'], "quantity"=>1]],
                    'callbackUrl' => getenv("app.baseURL").'/duitku/callback',
                    'expiryPeriod' => getenv("PERIOD_CHECKOUT"),
                    'signature' => md5(getenv("MERCHANT_CODE").$orderId.$dokter['price'].getenv("DUITKU_APIKEY"))
                ]
            ]);
            $json = json_decode($response->getBody(), true);
            if($json['statusCode'] == "00" || $json['statusMessage'] == "SUCCESS"){
                $data = [
                    'user_id' => $this->user['id'],
                    'dokter_id' => $this->request->getVar("dokter_id"),
                    'price' => $dokter['price'],
                    'discount' => 0,
                    'total_price' => $dokter['price'],
                    'status' => 0,
                    'registration_code' => $orderId
                ];
                $invId = $invoiceModel->createInvoice($json, $data, $paymentId);
                if(!$invId)
                    return $this->response("Kesalahan pada database!", null, 500);
                
                return $this->response("Berhasil melakukan checkout", $invId, 201);
            } else {
                return $this->response("Kesalahan pada payment gateway!", null, 500); 
            }
        } catch (\Exception $e) {
            return $this->response("Kesalahan pada payment gateway: ".$e->getMessage()."!", null, 500); 
        }
        return $this->response("Kesalahan pada database!", null, 500); 
    }

    public function give_rating()
    {
        if(!$this->user)
        return $this->response("Kesalahan pada database!", null, 500);
    
        helper(['form']);
        $rules = [
            'invoice_id' => 'required|is_not_unique[invoice.id]',
            'description' => 'required',
            'star' => 'required|numeric|greater_than[0]|less_than[6]'
        ];
        if(!$this->validate($rules))
            return $this->response("Harap isi formulir dengan benar!", null, 422, $this->validator->getErrors());
        $reviewModel = new ReviewModel();

        if(count($reviewModel->where(['invoice_id' => $this->request->getVar('invoice_id')])->findAll()))
            return $this->response("Sudah mengisi ulasan!", null, 409, null);
        
        if(!$reviewModel->protect(false)->insert([
            'invoice_id'=> $this->request->getVar('invoice_id'),
            'reviewed_by' => $this->user['id'],
            'star' => $this->request->getVar('star'),
            'description' => $this->request->getVar('description')
        ]))
            return $this->response("Kesalahan pada database!", null, 500); 
            
        return $this->response("Berhasil memberikan ulasan!", null, 201); 
    }
}