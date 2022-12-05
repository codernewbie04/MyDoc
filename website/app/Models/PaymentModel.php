<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'payment';
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


    public function getPaymentMethods()
    {
        return $this->db->table("payment_methods")->get()->getResultArray();
    }

    public function getPaymentId($code)
    {
        return $this->db->table("payment_methods")->where(['code' => $code])->get()->getRowArray()['id'];
    }

    public function getPaymentById($id)
    {
        return $this->db->table("payment_methods")->where(['id' => $id])->get()->getRowArray();
    }

    public function savePayment($payment)
    {
        if(!$this->db->table("payment_methods")->where(['code' => $payment['paymentMethod']])->countAllResults()){
            $data = [
                'code' => $payment['paymentMethod'],
                'paymentName' => $payment['paymentName'],
                'paymentImage' => $payment['paymentImage']
            ];
            $this->db->table("payment_methods")->insert($data);
        }
    }

    public function setPaymentSuccess($reg) {
        $inv_id = $this->db->table("invoice")->where(['registration_code' => $reg])->get()->getRowArray()['id'];
        $this->db->transStart();
        if($inv_id){
            $this->db->table("invoice")->where(['id' => $inv_id])->update(['status' => 1]);  
            $this->db->table("payment")->where(['invoice_id' => $inv_id])->update(['status' => 1]); 
        } else {
            $this->db->transRollback();
        }
        $this->db->transComplete();

        return $this->db->transStatus();
    }

    public function setPaymentFailed($reg){
        $inv_id = $this->db->table("invoice")->where(['registration_code' => $reg])->get()->getRowArray()['id'];
        $this->db->transStart();
        if($inv_id){
            $this->db->table("invoice")->where(['id' => $inv_id])->update(['status' => -1]);  
            $this->db->table("payment")->where(['invoice_id' => $inv_id])->update(['status' => -2]); 
        } else {
            $this->db->transRollback();
        }
        $this->db->transComplete();

        return $this->db->transStatus();
    }
}
