<?php

namespace App\Controllers\Master;
use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\InvoiceModel;
use App\Models\DokterModel;

class RiwayatBerobat extends BaseController
{
    public function index()
    {
        $invoiceModel = new InvoiceModel();
        $uid = -1;
        if($this->user['role'] != 1)
            $uid = $this->user['id'];
        // dd($invoiceModel->getInvoices($uid));
        return view('master/riwayat_berobat',[
            'title' => "Riwayat Berobat",
            'user' => $this->user,
            'list_riwayat' => $invoiceModel->getInvoices($uid)
        ]);
    }
}