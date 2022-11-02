<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\DokterModel;
use App\Models\PaymentModel;

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
}
