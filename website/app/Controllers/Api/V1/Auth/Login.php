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
            'password' => 'required',
            'fcm_token' => 'required'
        ];
        if(!$this->validate($rules))
            return $this->response("Form invalid!", null, 422, $this->validator->getErrors());
        $model = new UserModel();
        $authModel = new AuthModel();
        $user = $model->where("email", $this->request->getVar('email'))->first();
        if($user){
            $verify = password_verify($this->request->getVar("password"), $user['password_hash']);
            if($verify){
                $jti = substr(md5(time()), 3, 16);
                $login = $authModel->login($user, $jti, $this->request->getVar("fcm_token"));
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
                $rUser = $model->getUser($user["id"]);
                //$rUser['id'] = (int) $rUser['id'];
                return $this->response("Berhasil login!", ['token'=>$jwt, 'user' => $rUser], 200); 
            }
        }
        $authModel->setLoginLog($this->request->getVar('email'), null, 0);
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
        JWT::$leeway = 604800; //1 week
        $authModel = new AuthModel();
        try{
            $jwt = validateJWTFromRequest(getJWTFromRequest($this->request->getServer('HTTP_AUTHORIZATION')));
        } catch(\Exception $e){
            return $this->response($e->getMessage(), null, 403);
       }
        
        if($authModel->isTokenBlacklist($jwt->jti))
            return $this->response("Token Blacklist!", null, 403);
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
