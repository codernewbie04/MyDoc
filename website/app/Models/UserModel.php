<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields  = [
        "address", 'birthday', 'fullname', 'image'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'email'         => 'required|valid_email|is_unique[users.email,id,{id}]',
        'username'      => 'required|alpha_numeric_punct|min_length[3]|max_length[30]|is_unique[users.username,id,{id}]',
        'password_hash' => 'required',
    ];
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

    private $exceptFields     = ['password_hash', 'reset_hash', 'reset_at', 'reset_expires', 'activate_hash', 'status_message', 'force_pass_reset', 'deleted_at', 'uid'];
    
    public function createAccount($data){
        $this->db->transStart();
		$this->protect(false)->insert($data);

        $uid = $this->insertID();
        $balance = [
            'uid' => $uid,
            'balance' => 0
        ];
        $this->db->table('balance')->insert($balance);
        
        $role = ['group_id' => 3, 'user_id' => $uid];
        $this->db->table('auth_groups_users')->insert($role);

        $this->db->transComplete();
        return $uid;
    }
    // $user = $this->where("users.id", $id)
    // ->join("balance",'users.id=balance.uid')
    // ->select('id', 'users.id')
    // ->select('id', 'users.id')
    // ->first();
    // foreach($this->exceptFields as $key){
    //     unset($user[$key]);
    // }
    // return $user;

    public function getRole($id) {
        $role = $this->db->table('auth_groups_users')->where("user_id", $id)->get()->getRowArray();
        if($role)
            return $role['group_id'];
        return 3;
    }
    public function getUser($id){
        $user = $this->where("users.id", $id)
        ->join("balance",'users.id=balance.uid')
        ->select('*, users.id AS id', false)
        ->first();
        foreach($this->exceptFields as $key){
            unset($user[$key]);
        }
        return $user;
    }

    public function getUserWithoutFilter($id){
        $user = $this->where("users.id", $id)
        ->join("balance",'users.id=balance.uid')
        ->select('*, users.id AS id', false)
        ->first();
        return $user;
    }

    // For Admin=============================================================================================================================================================================
    public function getAdmin($id) {
        $user = $this->where("users.id", $id)
        ->join("auth_groups_users",'users.id=auth_groups_users.user_id')
        ->select('users.id, users.email, users.username, users.fullname, users.address, users.image, users.status, users.active, users.birthday, auth_groups_users.group_id as role', false)
        ->first();
        foreach($this->exceptFields as $key){
            unset($user[$key]);
        }
        return $user;
    }

    public function getListInstansi() {
        return $this->where("auth_groups_users.group_id", 2)
        ->join("auth_groups_users",'users.id=auth_groups_users.user_id')
        ->select('users.id, users.email, users.username, users.fullname, users.address, users.image, users.status, users.active, users.birthday, auth_groups_users.group_id as role', false)
        ->findAll();
    }

    public function getListPasien() {
        return $this->where("auth_groups_users.group_id", 3)
        ->join("auth_groups_users",'users.id=auth_groups_users.user_id')
        ->join("balance",'users.id=balance.uid')
        ->select('users.id AS id, users.email, users.username, users.fullname, users.address, users.image, users.status, users.active, users.birthday, auth_groups_users.group_id as role, balance.balance', false)
        ->findAll();
    }

    public function createInstansi($data) {
        $this->db->transStart();
		$this->protect(false)->insert($data);
        $uid = $this->insertID();
        $role = ['group_id' => 2, 'user_id' => $uid];
        $this->db->table('auth_groups_users')->insert($role);
        $this->db->transComplete();
        return $uid;        
    }

    public function getProyeksiKeuangan($uid) {
        return $this->db->table('balance_tracker')->where("user_id", $uid)->get()->getResultArray();
    }

    public function topupPasien($id = -1, $balance = 0) {
        $old_balance = $this->db->table('balance')->where(['uid' => $id])->get()->getRowArray()['balance'];
        $this->db->transStart();
        $this->db->table('balance')->where(['uid' => $id])->update(['balance' =>$old_balance + $balance]);
        $this->db->table('balance_tracker')->insert([
            'type' => 'in',
            'user_id' => $id,
            'amount' => $balance,
            'description' => 'Topup by Admin'
        ]);
        $this->db->transComplete();

        return $this->db->transStatus();
    }
}
