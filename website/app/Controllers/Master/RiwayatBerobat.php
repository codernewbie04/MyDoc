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

    public function edit(){
        $rules = [
            'id' => 'required|numeric',
            'status' => 'required|numeric'
        ];

        if(!$this->validate($rules))
            return redirect()->back()->withInput()->with('error', "Gagal menyimpan kedatabase");
        
        $model = new InvoiceModel();
        $success = $model->update($this->request->getVar('id'),[
            'status' => $this->request->getVar('status')
        ]);

        if(!$success)
            return redirect()->back()->withInput()->with('error', "Gagal menyimpan kedatabase");
        return redirect()->back()->withInput()->with('success', "Berhasil merubah data");
    }

    public function delete($id = -1){
        if($id == -1)
            return redirect()->back()->withInput()->with('error', "ID tidak ditemukan");
        $model = new InvoiceModel();
        $success = $model->delete($id);
        if(!$success)
            return redirect()->back()->withInput()->with('error', "Gagal menghapus data");
        return redirect()->back()->withInput()->with('success', "Berhasil menghapus data");

    }
}