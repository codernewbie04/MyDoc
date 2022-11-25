<?php

namespace App\Controllers\Master;
use App\Controllers\BaseController;


class Dashboard extends BaseController
{
    public function index()
    {
        return view('master/dashboard',[
            'title' => "Dashboard",
            'user' => $this->user
        ]);
    }
}