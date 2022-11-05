<?php

namespace App\Controllers\Api\V1\Profile;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\UserModel;
use App\Controllers\Api\V1\BaseResponse;

class Pasien extends BaseResponse
{
    private $user = null;
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->user = getUserFromToken($this->request->getServer('HTTP_AUTHORIZATION'));
    }

    public function index()
    {
        if(!$this->user)
            return $this->response("Kesalahan pada database!", null, 500); 
        
        return $this->response("Berhasil login!", $this->user, 200); 
    }

    public function update($id = null)
    {
        if(!$this->user)
            return $this->response("Kesalahan pada database!", null, 500); 
        helper(['form']);
        $rules = [
            'fullname' => 'required|alpha_space|min_length[3]',
            'address' => 'required',
            'birthday' => 'required|date_valid'
        ];
        if(!$this->validate($rules))
            return $this->response("Form invalid!", null, 422, $this->validator->getErrors());
        $model = new UserModel();
        if(!$model->update($this->user['id'], $this->request->getJSON("array")))
            return $this->response("Kesalahan pada database!", null, 500); 

        return $this->response("Berhasil merubah data!", getUserFromToken($this->request->getServer('HTTP_AUTHORIZATION')), 200, null);
    }

    public function change_password()
    {
        if(!$this->user)
            return $this->response("Kesalahan pada database!", null, 500); 

        helper(['form']);
        $rules = [
            'old_password' => 'required',
            'new_password1' => 'required|min_length[8]',
            'new_password2' => 'required|min_length[8]|matches[new_password1]'
        ];
        if(!$this->validate($rules))
            return $this->response("Form invalid!", null, 422, $this->validator->getErrors());
        $model = new UserModel();
        $old_pass_db = $model->getUserWithoutFilter($this->user['id'])['password_hash'];
        if(!password_verify($this->request->getVar("old_password"), $old_pass_db))
            return $this->response("Password lama salah!", null, 403, null);
            
        if(!$model->protect(false)->update($this->user['id'], ['password_hash' => password_hash($this->request->getVar("new_password2"), PASSWORD_BCRYPT)]))
            return $this->response("Kesalahan pada database!", null, 500); 
        
        
        return $this->response("Berhasil mengganti password", null, 200, null);        
    }
}
