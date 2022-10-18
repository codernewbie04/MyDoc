<?php

namespace App\Controllers\Api\V1\Auth;

use App\Models\UserModel;
use App\Controllers\Api\V1\BaseResponse;
class Register extends BaseResponse
{
    public function index()
    {
        helper(['form']);
        $rules = [
            'fullname' => 'required|alpha_space',
            'email' => 'required|valid_email|is_unique[users.email]',
            'birthdate' => 'required',
            'address' => 'required',
            'password1' => 'required|min_length[6]',
            'password2' => 'required|matches[password1]'
        ];
        if(!$this->validate($rules))
            return $this->response("Form invalid!", null, 422, $this->validator->getErrors());

        $email = $this->request->getVar("email");
        $uname = explode("@", $email)[0].rand(000,999);
        $data = [
            'fullname' => $this->request->getVar("fullname"),
            'email' => $this->request->getVar("email"),
            'username' => $uname,
            'birthdate' => $this->request->getVar("birthdate"),
            'address' => $this->request->getVar("address"),
            'password_hash' => password_hash($this->request->getVar("password1"), PASSWORD_BCRYPT),
        ];
        $model = new UserModel();
        $sv = $model->createAccount($data);
        if(!$sv)
            return $this->response("Gagal menyimpan kedatabase!", null, 500);
        
        return $this->response("Berhasil register!", null, 201);
        
    }

}
