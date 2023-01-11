<?php

use App\Models\UserModel;
use Config\Services;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function getJWTFromRequest($authenticationHeader): string
{
    if (is_null($authenticationHeader)) { //JWT is absent
        throw new Exception('Missing or invalid JWT in request');
    }
    //JWT is sent from client in the format Bearer XXXXXXXXX
    return explode(' ', $authenticationHeader)[1];
}

function validateJWTFromRequest(string $encodedToken)
{
    
    $key = getenv('JWT_SECRET');
    $decodedToken = JWT::decode($encodedToken, new Key($key, 'HS256'));
    return $decodedToken;
}

function getUserFromToken($header){
    $key = getenv('JWT_SECRET');
    $decodedToken = JWT::decode(getJWTFromRequest($header), new Key($key, 'HS256'));
    $userModel = new UserModel();
    
    return $userModel->getUser($decodedToken->uid);
}

function tokenToUser($token) {
    $key = getenv('JWT_SECRET');
    $decodedToken = JWT::decode($token, new Key($key, 'HS256'));
    $userModel = new UserModel();
    $user = $userModel->getAdmin($decodedToken->uid);
    return $user;
}