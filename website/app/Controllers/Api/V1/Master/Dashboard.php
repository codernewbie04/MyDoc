<?php

namespace App\Controllers\Api\V1\Master;

use App\Models\InvoiceModel;
use App\Models\ReviewModel;
use App\Controllers\Api\V1\BaseResponse;

class Dashboard extends BaseResponse
{
    public function index()
    {
        helper('jwt');
        $user = getUserFromToken($this->request->getServer('HTTP_AUTHORIZATION'));
        if(!$user)
            return $this->response("Kesalahan pada database!", null, 500); 
        
        helper('jwt');
        $user = getUserFromToken($this->request->getServer('HTTP_AUTHORIZATION'));
        $invoiceModel = new InvoiceModel();
        $reviewModel = new ReviewModel();
        return $this->response("Berhasil login!", ["user" => $user, "history"=>$invoiceModel->getInvoiceUser($user['id'], 5), "my_review"=> $reviewModel->getReviewsUser($user['id'])], 200); 
    }
}