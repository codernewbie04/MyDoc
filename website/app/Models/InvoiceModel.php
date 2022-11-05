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

        foreach ($invoices as $inv) {
            $inv["payment"] = (new PaymentModel())->where('id', $inv['id'])->first();
            $inv["dokter"] = (new DokterModel())->where('id', $inv['dokter_id'])->first();            
            array_push($clearInvoice, $inv);
        }
        
        return $clearInvoice;
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
}
