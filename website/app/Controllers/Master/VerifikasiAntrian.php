<?php

namespace App\Controllers\Master;
use App\Controllers\BaseController;
use App\Models\InvoiceModel;
use Carbon\Carbon;

class VerifikasiAntrian extends BaseController
{
    public function index()
    {
        $jadwalReserve = Carbon::createFromFormat('Y-m-d H:i:s',  '2022-12-05 14:01:01')->locale('id'); 
        // dd($jadwalReserve->isoFormat('dddd, D MMMM Y, HH:mm:ss'));
        $invoiceModel = new InvoiceModel();
        $uid = -1;
        if($this->user['role'] != 1)
            $uid = $this->user['id'];
        return view('master/verifikasi_antrian',[
            'title' => "Verifikasi Antrian",
            'user' => $this->user,
            'invoices' => $invoiceModel->getInvoices($uid)
        ]);
    }

    public function confirm(){
        $invoiceModel = new InvoiceModel();
        $rules = [
            'registration_code' => 'required'
        ];
        if(!$this->validate($rules))
            return redirect()->back()->withInput()->with('error', "Gagal! Harap isi form dengan benar.");
        //$this->request->getVar("id")
        if(!$invoiceModel->confirmInvoice($this->request->getVar("registration_code")))
            return redirect()->back()->withInput()->with('error', "Terjadi kesalahan pada database!");
        return redirect()->back()->with('success', 'Berhasil mengkonfirmasi antrian!');
    }

    public function refund($invoice_id = -1){
        if($invoice_id <= 0)
            return redirect()->back()->with('error', 'Invoice tidak ditemukan!');
        $invoiceModel = new InvoiceModel();
        if(!$invoiceModel->refundInvoice($invoice_id))
            return redirect()->back()->withInput()->with('error', "Terjadi kesalahan pada database!");
        return redirect()->back()->with('success', 'Berhasil me-refund antrian!');
    }
}