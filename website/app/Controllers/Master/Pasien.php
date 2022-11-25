<?php

namespace App\Controllers\Master;
use App\Controllers\BaseController;
use App\Models\UserModel;

class Pasien extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        return view('master/pasien',[
            'title' => "List Pasien",
            'user' => $this->user,
            'list_pasien' => $model->getListPasien()
        ]);
    }
}