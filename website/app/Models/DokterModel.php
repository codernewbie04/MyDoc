<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\InvoiceModel;

class DokterModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'dokter';
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

    public function getDokterAndInstansi(){
        $doctor = $this->join("users",'users.id=dokter.instansi_id')
        ->select('dokter.*, users.fullname AS instansi', false)
        ->findAll();
        $dr=array();
        $inv_model = new InvoiceModel();
        foreach($doctor as $dct){
            $dct["review"] = $inv_model->getReview($dct['id']);
            $schedule =$this->getSchedule($dct['id']);
            $dct["schedule"] = ["list_schedule" => $schedule];

            $day = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"];
            $listHari = array();
            foreach($schedule as $s){
                if(in_array($s['day'], $day)){
                    $key = array_search($s['day'], $day);
                    unset($day[$key]);
                }
            }
            $dct["schedule"]["no_schedule_at"] = array_values($day);   
            array_push($dr, $dct);
        }
        

        return $dr;
    }

    public function getDetailDokter($id = 0){
        if($id == 0)
            return null;
        $doctor = $this->join("users",'users.id=dokter.instansi_id')
        ->select('dokter.*, users.fullname AS instansi', false)
        ->where(["dokter.id" => $id])
        ->first();
        if($doctor<=0)
            return null;
        $inv_model = new InvoiceModel();
        $doctor["review"] = $inv_model->getReview($doctor['id']);
        $schedule = $this->getSchedule($doctor['id']);
        $doctor["schedule"] = ["list_schedule" => $schedule];

        $day = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"];
        $listHari = array();
        foreach($schedule as $s){
            if(in_array($s['day'], $day)){
                $key = array_search($s['day'], $day);
                unset($day[$key]);
            }
        }
        $doctor["schedule"]["no_schedule_at"] = array_values($day);   
        

        return $doctor;
    }

    private function getSchedule($id = 0){
        if($id == 0)
            return null;
        
        return $this->db->table("schedule")->where(["dokter_id" => $id])->get()->getResultArray();
    }

    
}
