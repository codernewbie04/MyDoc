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
    protected $useSoftDeletes   = true;
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
            $img = $dct['image'];
            $dct["image"] = base_url("assets/images/doctor/$img"); 
            $dct["review"] = $inv_model->getReview($dct['id']);
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
        $jadwal = $this->getSchedule($doctor['id']);
        

        $day = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"];
        $listHari = array();
        foreach($jadwal as $s){
            if(in_array($s['day'], $day)){
                $key = array_search($s['day'], $day);
                unset($day[$key]);
            }
        }
        foreach($day as $d){
            array_push($jadwal, [
                'id' => -1,
                'dokter_id' => -1,
                'day' => $d,
                'time_start' => null,
                "time_end" => null,
                'created_at' => null
            ]);
        }

        $prio = [
            "Senin"     => 7, 
            "Selasa"    => 6, 
            "Rabu"      => 5, 
            "Kamis"     => 4,
            "Jumat"     => 3,
            "Sabtu"     => 2, 
            "Minggu"    => 1
        ];
        $jadwal = array_values($this->sorting_day($jadwal, "day", $prio));
        $doctor["schedule"] = $jadwal;

        $img = $doctor['image'];
        $doctor["image"] = base_url("assets/images/doctor/$img");
        

        return $doctor;
    }

    private function sorting_day(array &$array, $offset, array $priorities)
    {
        uasort($array, function ($a, $b) use ($offset, $priorities) {
            if (!isset($a[$offset])) {
                return !isset($b[$offset])
                    ? 0
                    : 1; // down
            } elseif (!isset($b[$offset])) {
                return -1; // up
            }
            if (isset($priorities[$a[$offset]])) {
                if (!isset($priorities[$b[$offset]])) {
                    return -1; // up
                }
                return $priorities[$a[$offset]] > $priorities[$b[$offset]]
                    ? -1 // up
                    : 1; // down
            }
            return isset($priorities[$b[$offset]])
                ? 1 // down
                : 0;
        });
        return $array;
    }

    private function getSchedule($id = 0){
        if($id == 0)
            return null;
        
        return $this->db->table("schedule")->where(["dokter_id" => $id])->get()->getResultArray();
    }

    // For Admin=============================================================================================================================================================================
    public function getListDokter($instansi = -1) {
        $doctor = $this->join("users",'users.id=dokter.instansi_id')
        ->select('dokter.*, users.fullname AS instansi', false);
        if($instansi != -1)
            $doctor->where(['dokter.instansi_id' => $instansi]);
        return $doctor->findAll();
    }
    
    public function getDetailDokterOwnInstansi($dokter_id = -1, $instansi_id = -1) 
    {
        if($dokter_id == -1 || $instansi_id == -1)
            return null;
        $doctor = $this->join("users",'users.id=dokter.instansi_id')
        ->select('dokter.*, users.fullname AS instansi', false)
        ->where(["dokter.id" => $dokter_id, 'users.id' => $instansi_id])
        ->first();
        if($doctor<=0)
            return null;
        $inv_model = new InvoiceModel();
        $doctor["review"] = $inv_model->getReview($doctor['id']);
        $jadwal = $this->getSchedule($doctor['id']);
        

        $day = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"];
        $listHari = array();
        foreach($jadwal as $s){
            if(in_array($s['day'], $day)){
                $key = array_search($s['day'], $day);
                unset($day[$key]);
            }
        }
        foreach($day as $d){
            array_push($jadwal, [
                'id' => -1,
                'dokter_id' => -1,
                'day' => $d,
                'time_start' => null,
                "time_end" => null,
                'created_at' => null
            ]);
        }
        $prio = [
            "Senin"     => 7, 
            "Selasa"    => 6, 
            "Rabu"      => 5, 
            "Kamis"     => 4,
            "Jumat"     => 3,
            "Sabtu"     => 2, 
            "Minggu"    => 1
        ];
        $jadwal = array_values($this->sorting_day($jadwal, "day", $prio));
        $doctor["schedule"] = $jadwal;
        

        return $doctor;
    }

    public function getDetailReviews($dokter_id = -1)
    {
        if($dokter_id == -1)
            return null;
        $reviews = $this->db->table("invoice")
        ->select('users.fullname, reviews.star, reviews.description, reviews.created_at', false)
        ->join("reviews", "reviews.invoice_id=invoice.id")
        ->join("users", "users.id=reviews.reviewed_by")
        ->where(["invoice.dokter_id" => $dokter_id]);
        return $reviews->get()->getResultArray();
    }

    public function addSchedule($did, $uid, $data) {
        if(count($this->where(['id' => $did, 'instansi_id' => $uid])->findAll()) <= 0)
            return false;
        return $this->db->table("schedule")->insert($data);
    }

    public function editOwnSchedule($jid, $did, $uid, $data) {
        if(count($this->where(['id' => $did, 'instansi_id' => $uid])->findAll()) <= 0)
            return false;
        return $this->db->table("schedule")->update($data, ['id' => $jid]);
    }

    public function deleteOwnSchedule($jid, $did, $uid) {
        if(count($this->where(['id' => $did, 'instansi_id' => $uid])->findAll()) <= 0)
            return false;
            
        return $this->db->table("schedule")->delete(['id' => $jid]);
    }
}
