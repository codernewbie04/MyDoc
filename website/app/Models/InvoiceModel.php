<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\DokterModel;
use App\Models\PaymentModel;
use App\Models\UserModel;

class InvoiceModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'invoice';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    private $exceptFields     = ['user_id'];


    public function getInvoiceUser($id, $limit = 0){
        //->select("id, no_invoice, price, discount, total_price, status, registration_code, created_at", false)
        $invoices = $this->where("user_id", $id)->findAll($limit);
        $clearInvoice = array();
        $paymentModel = new PaymentModel();
        foreach ($invoices as $inv) {
            $inv["payment"] = $paymentModel->where('id', $inv['id'])->first();
            if(isset($inv["payment"]))
                if($inv["payment"]['payment_method']){
                    $inv["payment"]['payment_method'] = $paymentModel->getPaymentById($inv["payment"]['payment_method']);
                }
            $inv["dokter"] = (new DokterModel())->where('id', $inv['dokter_id'])->first();            
            array_push($clearInvoice, $inv);
        }
        
        return $clearInvoice;
    }

    public function getInvoice($id, $uid)
    {
        $invoice = $this->where(["user_id" => $uid, 'id' => $id])->first();
        if($invoice){
            $paymentModel = new PaymentModel();
            $invoice["payment"] = $paymentModel->where('id', $invoice['id'])->first();
            
            if(isset($invoice["payment"]))
                if($invoice["payment"]['payment_method']){
                    $invoice["payment"]['payment_method'] = $paymentModel->getPaymentById($invoice["payment"]['payment_method']);
                }

            $invoice["dokter"] = (new DokterModel())->where('id', $invoice['dokter_id'])->first();  
        }
              
        return $invoice;
    }

    public function getReview($id = 0){
        if($id ==0)
            return null;
        $allRating = array();
        $rating = $this
        ->select("reviews.id, reviews.reviewed_by, reviews.star, reviews.description, reviews.created_at", false)
        ->join("reviews",'invoice.id=reviews.invoice_id')
        ->where(['invoice.dokter_id' => $id])->findAll();
        $userModel = new UserModel();
        foreach($rating as $rat){
            $uid= $rat['reviewed_by'];
            $dataUser = $userModel->getUser($uid);
            unset($dataUser["email"]);
            unset($dataUser["username"]);
            unset($dataUser["address"]);
            unset($dataUser["status"]);
            unset($dataUser["active"]);
            unset($dataUser["birthday"]);
            unset($dataUser["updated_at"]);
            unset($dataUser["balance"]);
            $rat["reviewed_by"] = $dataUser;
            array_push($allRating, $rat);
        }
        $review = [
            'rating_average' => $this->getReviewAvg($id),
            'rating_count' => $this->getReviewCount($id),
            'ratings' => $allRating
        ];

        return $review;
    }

    private function getReviewCount($id = 0){
        if($id ==0)
            return 0;
        return $this
        ->select("count(reviews.id) as count_review", false)
        ->join("reviews",'invoice.id=reviews.invoice_id')
        ->where(['invoice.dokter_id' => $id])->first()["count_review"];
    }

    private function getReviewAvg($id = 0){
        if($id ==0)
            return 0;
        return (int) $this
        ->select("avg(reviews.star) as avg_review", false)
        ->join("reviews",'invoice.id=reviews.invoice_id')
        ->where(['invoice.dokter_id' => $id])->first()["avg_review"];
    }

    public function getLastOrderId()
    {
        return count($this->findAll());
    }

    public function createInvoice($paymentData, $invData, $paymentId)
    {
        $invData['no_invoice'] = $this->createNoInvoice();
        $this->db->transStart();
        $this->protect(false)->insert($invData);
        $invId = $this->insertID();
        $payment = [
            "invoice_id" => $invId,
            'amount' => $invData["total_price"],
            'payment_method' => $paymentId
        ];
        if(array_key_exists("reference", $paymentData))
            $payment['reference'] = $paymentData["reference"];

        if(array_key_exists("paymentUrl", $paymentData))
            $payment['url'] = $paymentData["paymentUrl"];
        
        if(array_key_exists("qrString", $paymentData))
            $payment['qr_code'] = $paymentData["qrString"];

        if(array_key_exists("vaNumber", $paymentData))
            $payment['vaNumber'] = $paymentData["vaNumber"];

        $this->db->table('payment')->insert($payment);
        $this->db->transComplete();
        return $invId;
    }

    private function createNoInvoice()
    {
        $last = count($this->where("DATE(created_at) = CURDATE()")->findAll());
        return "MD-".date("dm")."-".sprintf('%03d', ($last + 1));
    }


    // For Admin=============================================================================================================================================================================

    public function getTotalHistory($instansi = -1) {
        $query = $this
        ->select("count(invoice.id) as total", false)
        ->join("dokter",'invoice.dokter_id=dokter.id');
        if($instansi != -1)
            $query->where(['dokter.instansi_id' => $instansi]);
        return $query->first()["total"];
    }

    public function getInvoices($instansi = -1) {
        $invoices = $this->protect(false)
        ->join("users",'users.id=invoice.user_id')
        ->join("dokter",'invoice.dokter_id=dokter.id')
        ->select("invoice.*, users.fullname", false);
        if($instansi != -1)
            $invoices->where(['dokter.instansi_id' => $instansi]);
        
        $invoices = $invoices->findAll();
        $clearInvoice = array();
        $paymentModel = new PaymentModel();
        foreach ($invoices as $inv) {
            $inv["payment"] = $paymentModel->where('id', $inv['id'])->first();
            if(isset($inv["payment"]))
                if($inv["payment"]['payment_method']){
                    $inv["payment"]['payment_method'] = $paymentModel->getPaymentById($inv["payment"]['payment_method']);
                }
            $inv["dokter"] = (new DokterModel())->where('id', $inv['dokter_id'])->first();            
            array_push($clearInvoice, $inv);
        }
        
        return $clearInvoice;
    }
}
