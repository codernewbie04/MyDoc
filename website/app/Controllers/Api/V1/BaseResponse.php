<?php

namespace App\Controllers\Api\V1;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class BaseResponse extends ResourceController
{
    use ResponseTrait;
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        helper('jwt');
    }

    public function response($message = "Berhasil mendapatkan data!", $data = null, $code = 200, $error = null)
    {
        return $this->setResponseFormat('json')->respond([
            'message' => $message,
            'data' => $data,
            'form_error' => $error
        ], $code);
    }
}
