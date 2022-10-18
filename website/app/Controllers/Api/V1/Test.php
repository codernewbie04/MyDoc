<?php

namespace App\Controllers\Api\V1;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Models\UserModel;
use App\Controllers\Api\V1\BaseResponse;

class Test extends BaseResponse
{
    public function index()
    {   
        return $this->response("Berhasil login!", null, 200); 
    }

}
