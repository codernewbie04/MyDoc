<?php

namespace App\Controllers\Api\V1\Auth;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Controllers\Api\V1\BaseResponse;
use App\Models\UserModel;
use App\Models\AuthModel;

class Login extends BaseResponse
{
    public function index()
    {
        helper(['form']);
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required'
        ];
        if(!$this->validate($rules))
            return $this->response("Form invalid!", null, 422, $this->validator->getErrors());
        $model = new UserModel();
        $user = $model->where("email", $this->request->getVar('email'))->first();
        if($user){
            $verify = password_verify($this->request->getVar("password"), $user['password_hash']);
            if($verify){
                $authModel = new AuthModel();
                $jti = substr(md5(time()), 3, 16);
                $login = $authModel->login($user, $jti);
                if (!$login)
                    return $this->response("Gagal menyimpan token kedatabase", null, 500);
                $payload = [
                    'jti' => $jti,
                    'iss' => getenv("app.baseURL"),
                    'iat' => time(),
                    'exp' => time()+getenv("JWT_TIME_TO_LIVE"),
                    'uid' => $user['id'],
                    'email' => $user['email']
                ];
                $jwt = JWT::encode($payload, getenv("JWT_SECRET"), 'HS256');
                
                return $this->response("Berhasil login!", ['token'=>$jwt, 'user' => $model->getUser($user["id"])], 200); 
            }
        }
        $model->setLoginLog($this->request->getVar('email'), null, 0);
        return $this->response("Email atau password salah!", null, 404);
    }

    public function logout(){
        helper('jwt');
        $authModel = new AuthModel();
        $jwt = validateJWTFromRequest(getJWTFromRequest($this->request->getServer('HTTP_AUTHORIZATION')));
        if(!$authModel->logout($jwt->jti))
            return $this->response("Terjadi kesalahan pada database!", null, 500);
        return $this->response("Berhasil logout!", null, 200);
    }


    public function refresh(){
        helper('jwt');
        $authModel = new AuthModel();
        $jwt = validateJWTFromRequest(getJWTFromRequest($this->request->getServer('HTTP_AUTHORIZATION')));
        $jti = substr(md5(time()), 3, 16);
        $user = getUserFromToken($this->request->getServer('HTTP_AUTHORIZATION'));
        $payload = [
                    'jti' => $jti,
                    'iss' => getenv("app.baseURL"),
                    'iat' => time(),
                    'exp' => time()+getenv("JWT_TIME_TO_LIVE"),
                    'uid' => $user['id'],
                    'email' => $user['email']
                ];
        if(!$authModel->renewToken($jwt->jti, $jti))
            return $this->response("Terjadi kesalahan pada database!", null, 500);
            
        $jwt = JWT::encode($payload, getenv("JWT_SECRET"), 'HS256');
        return $this->response("Token berhasil diperbaharui!", $jwt, 201);

    }
}
