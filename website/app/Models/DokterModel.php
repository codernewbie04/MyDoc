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

    
}
