<?php

namespace App\Controllers\Auth;
use App\Controllers\BaseController;

use App\Models\UserModel;
use App\Models\AuthModel;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Login extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }

    public function execute()
    {
        helper(['form']);
        $rules = [
            'login' => 'required',
            'password' => 'required'
        ];

        if(!$this->validate($rules))
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        
            
        $model = new UserModel();
        $authModel = new AuthModel();
        $findByEmail = $model->where("email", $this->request->getVar('login'))->first();
        $findByUsername = $model->where("username", $this->request->getVar('login'))->first();
        if($findByEmail || $findByUsername){

            if($findByUsername){
                $verify = password_verify($this->request->getVar("password"), $findByUsername['password_hash']);
                $user = $findByUsername;
            } else {
                $verify = password_verify($this->request->getVar("password"), $findByEmail['password_hash']);
                $user = $findByEmail;
            }
                
            
            if($verify) {
                $jti = substr(md5(time()), 3, 16);
                $login = $authModel->admin_login($user, $jti);
                if (!$login)
                    return redirect()->back()->withInput()->with('error', "Terjadi kesalahan pada database, coba lagi!");
                $role = $model->getRole($user['id']);
                if($role>=3)
                return redirect()->back()->withInput()->with('error', "Role pasien tidak dapat login!");
                $payload = [
                    'jti' => $jti,
                    'iss' => getenv("app.baseURL"),
                    'iat' => time(),
                    'exp' => time()+getenv("JWT_TIME_TO_LIVE"),
                    'uid' => $user['id'],
                    'email' => $user['email'],
                    'role' => $role
                ];
                $jwt = JWT::encode($payload, getenv("JWT_SECRET"), 'HS256');
                session()->set([getenv("JWT_WEB_NAME") => $jwt]);
                
                return $jwt;
            }
        }
        
        return redirect()->back()->withInput()->with('error', "Username/Email atau Password salah!");
        //session()->set([]);

        return "200";
    }
}