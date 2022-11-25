<?php

namespace App\Controllers\Master;
use App\Controllers\BaseController;
use App\Models\UserModel;

class Instansi extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        return view('master/instansi',[
            'title' => "List Instansi",
            'user' => $this->user,
            'list_instansi' => $model->getListInstansi()
        ]);
    }
}