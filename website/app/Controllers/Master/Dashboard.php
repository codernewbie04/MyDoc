<?php

namespace App\Controllers\Master;
use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\InvoiceModel;
use App\Models\DokterModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $invoiceModel = new InvoiceModel();
        $dokterModel = new DokterModel();
        $uid = -1;
        if($this->user['role'] != 1)
            $uid = $this->user['id'];
        return view('master/dashboard',[
            'title' => "Dashboard",
            'user' => $this->user,
            'total_pasien' => count($userModel->getListPasien()),
            'total_berobat' => $invoiceModel->getTotalHistory($uid),
            'total_instansi' => count($userModel->getListInstansi()),
            'total_dokter' => count($dokterModel->getListDokter($uid)),
        ]);
    }
}