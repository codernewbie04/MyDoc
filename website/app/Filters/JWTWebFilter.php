<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
use App\Models\AuthModel;

class JWTWebFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $route = 'auth/login';
        if(!session(getenv("JWT_WEB_NAME")))
            return redirect()->to(site_url($route));
        try {
            helper('jwt');
            $decode = validateJWTFromRequest(session(getenv("JWT_WEB_NAME")));
            $model = new AuthModel();
            if($model->isTokenBlacklist($decode->jti))
                return redirect()->to(site_url($route));

                
            return $request;
        } catch (Exception $e) {
            return redirect()->to(site_url($route))->with('error', 'Sesi habis, silakan login ulang!');
        }
        
    }

    public function after(RequestInterface $request,
                          ResponseInterface $response,
                          $arguments = null)
    {
    }
}