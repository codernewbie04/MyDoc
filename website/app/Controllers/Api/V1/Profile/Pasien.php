<?php

namespace App\Controllers\Api\V1\Profile;

use App\Models\UserModel;
use App\Controllers\Api\V1\BaseResponse;

class Pasien extends BaseResponse
{
    public function index()
    {
        helper('jwt');
        $user = getUserFromToken($this->request->getServer('HTTP_AUTHORIZATION'));
        if(!$user)
            return $this->response("Kesalahan pada database!", null, 500); 
        

        
        return $this->response("Berhasil login!", $user, 200); 
    }
}
