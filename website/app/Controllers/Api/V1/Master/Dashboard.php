<?php

namespace App\Controllers\Api\V1\Master;

use App\Models\InvoiceModel;
use App\Models\ReviewModel;
use App\Controllers\Api\V1\BaseResponse;

class Dashboard extends BaseResponse
{
    public function index()
    {
        if(strtolower(getenv("ON_TESTING")) == "true" && $this->request->getVar('test_token')){
            $user = getUserFromToken($this->request->getVar('test_token'));
        } else {
            $user = getUserFromToken($this->request->getServer('HTTP_AUTHORIZATION'));
        }
        $invoiceModel = new InvoiceModel();
        $reviewModel = new ReviewModel();
        return $this->response("Berhasil mendapatkan data!", ["user" => $user, "history"=>$invoiceModel->getInvoiceUser($user['id'], 5), "my_review"=> $reviewModel->getReviewsUser($user['id'])], 200); 
    }
}