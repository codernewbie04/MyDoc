<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'auth_jwt';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['blacklist', 'jti'];

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

    private function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    public function setLoginLog($email, $uid = null, $status=0){
        $data = [
            'ip_address' => $this->get_client_ip(), 
            'email' => $email,
            'user_id' => $uid,
            'success' => $status
        ];
        $this->db->table('auth_logins')->insert($data);
    }

    private function getFcmToken($fcm, $id){
        return $this->db->table("fcm_token")->where(["token" => $fcm, "user_id" => $id])->countAllResults();
    }

    public function isTokenBlacklist($jti){
        return $this->db->table('auth_jwt')->where('jti', $jti)->where('blacklist', 1)->countAllResults();
    }

    public function login($user=null, $jti, $fcm){
        if($user){
            $this->setLoginLog($user['email'], $user['id'], 1);
            $fcm_data = [
                'user_id' => $user['id'],
                'token' => $fcm
            ];
            if($fcm != null)
                if($this->getFcmToken($fcm, $user['id']) == 0)
                    $this->db->table('fcm_token')->insert($fcm_data);
        }
            
        $data = [
            'jti' => $jti,
            'blacklist' => 0
        ];
        return $this->db->table('auth_jwt')->insert($data);
    }

    public function logout($jti){
        return $this
        ->where('jti', $jti)
        ->set(['blacklist' => 1])
        ->update();
    }

    public function renewToken($jti, $newjti){
        $this->db->transStart();
        $this->logout($jti);
        $this->login(null, $newjti, null);
        return $this->db->transComplete();
    }
}
