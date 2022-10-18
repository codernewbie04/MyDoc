<?php

namespace App\Filters;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Exception;
use App\Models\AuthModel;

class JWTAuthenticationFilter implements FilterInterface
{
    use ResponseTrait;

    public function before(RequestInterface $request, $arguments = null)
    {
        $authenticationHeader = $request->getServer('HTTP_AUTHORIZATION');

        try {

            helper('jwt');
            $encodedToken = getJWTFromRequest($authenticationHeader);
            $decode = validateJWTFromRequest($encodedToken);
            $model = new AuthModel();
            if($model->isTokenBlacklist($decode->jti))
                return Services::response()
                ->setJSON(
                    [
                        'message' => "Token blacklist!",
                        'data' => null,
                        'form_error' => null
                    ]
                )
                ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
            return $request;
        } catch (Exception $e) {

            return Services::response()
                ->setJSON(
                    [
                        'message' => "Missing or invalid JWT in request",
                        'data' => null,
                        'form_error' => null
                    ]
                )
                ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);

        }
    }

    public function after(RequestInterface $request,
                          ResponseInterface $response,
                          $arguments = null)
    {
    }
}
