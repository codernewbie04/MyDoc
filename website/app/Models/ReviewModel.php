<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\InvoiceModel;
use App\Models\DokterModel;

class ReviewModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'reviews';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = false;
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


    public function getReviewsUser($id){
        $reviews = $this->where("reviewed_by", $id)->findAll();
        $clearReview = array();

        foreach ($reviews as $rev) {
            $dId = (new InvoiceModel())->select("dokter_id", false)->where('id', $rev['invoice_id'])->first()['dokter_id'];
            $rev["dokter"] = (new DokterModel())->where('id', $dId)->first();
            array_push($clearReview, $rev);
        }
        
        return $clearReview;
    }
}
