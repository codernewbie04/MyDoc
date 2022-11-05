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
    protected $useSoftDeletes   = false;
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
}
