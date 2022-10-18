<?php

namespace App\Controllers\Api\V1;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class BaseResponse extends ResourceController
{
    use ResponseTrait;
    public function response($message = "Berhasil mendapatkan data!", $data = null, $code = 200, $error = null)
    {
        return $this->setResponseFormat('json')->respond([
            'message' => $message,
            'data' => $data,
            'form_error' => $error
        ], $code);
    }
}
