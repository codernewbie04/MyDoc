<?php

namespace App\Controllers\Master;
use App\Controllers\BaseController;
use App\Models\DokterModel;
use Exception;

class Dokter extends BaseController
{
    public function index()
    {
        $dokterModel = new DokterModel();
        $uid = -1;
        if($this->user['role'] != 1)
            $uid = $this->user['id'];
        return view('master/dokter',[
            'title' => "List Dokter",
            'user' => $this->user,
            'list_dokter' => $dokterModel->getListDokter($this->user['id'])
        ]);
    }

    public function tambah()
    {
        return view('master/tambah_dokter',[
            'title' => "Tambah Dokter",
            'user' => $this->user
        ]);
    }

    public function add() {
        helper(['form']);
        $rules = [
            'nama' => 'required|alpha_space',
            'profession' => 'required|alpha_space',
            'price' => 'required|numeric',
            'foto_dokter' => "if_exist|mime_in[foto_dokter,image/jpg,image/jpeg,image/gif,image/png]|max_size[foto_dokter,3024]"
        ];
        $dokterModel = new DokterModel();
        $fileName = "dokter.jpg";
        try {
            $img = $this->request->getFile('foto_dokter');
        } catch (Exception $e) {
            $img = null;
        }

        if(!$this->validate($rules))
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        if($img->isValid()){
            $fileName = $img->getRandomName();
            $img->move('assets/images/doctor/', $fileName);
        }
            
        if(!$dokterModel->protect(false)->insert([
            'instansi_id' => $this->user['id'],
            'nama' => $this->request->getVar("nama"),
            'profession' => $this->request->getVar("profession"),
            'price' => $this->request->getVar("price"),
            'image' => $fileName
        ]))
            return redirect()->back()->withInput()->with('error', "Terjadi kesalahan pada database!");
        return redirect()->to(site_url("admin/dokter"))->with('success', 'Berhasil menambah dokter!');
    }

    public function edit() {
        helper(['form']);
        $rules = [
            'id' => 'required|numeric',
            'nama' => 'required|alpha_space',
            'profession' => 'required|alpha_space',
            'price' => 'required|numeric',
            'foto_dokter' => "if_exist|mime_in[foto_dokter,image/jpg,image/jpeg,image/gif,image/png]|max_size[foto_dokter,3024]"
        ];
        $dokterModel = new DokterModel();
        try {
            $img = $this->request->getFile('foto_dokter');
            $fileName = $img->getRandomName();
        } catch (Exception $e) {
            $img = null;
            $fileName = "dokter.jpg";
        }

        if(!$this->validate($rules))
            return redirect()->back()->withInput()->with('error', "Form tidak valid!");

        $data = [
            'nama' => $this->request->getVar("nama"),
            'profession' => $this->request->getVar("profession"),
            'price' => $this->request->getVar("price")
        ];
        if($img->isValid()){
            $data['image'] = $fileName;
            $oldImg = $dokterModel->where(['id' => $this->request->getVar("id")])->first();
            if($oldImg)
                if($oldImg['image'] != "dokter.jpg")
                    if(file_exists('assets/images/doctor/'.$oldImg['image']))
                        unlink('assets/images/doctor/'.$oldImg['image']);
            $img->move('assets/images/doctor/', $fileName);
        }
        if(!$dokterModel->protect(false)->where(['instansi_id' =>$this->user['id']])->update($this->request->getVar("id"), $data))
            return redirect()->back()->withInput()->with('error', "Terjadi kesalahan pada database!");
        return redirect()->to(site_url("admin/dokter"))->with('success', 'Berhasil merubah data dokter!');
    }
    
    public function delete($id = -1) {
        if($id == -1)
            return redirect()->back()->withInput()->with('error', "Dokter tidak boleh kosong!");
        $dokterModel = new DokterModel();
        if(!$dokterModel->where(['instansi_id' =>$this->user['id']])->delete($id))
            return redirect()->back()->withInput()->with('error', "Terjadi kesalahan pada database!"); 
        return redirect()->to(site_url("admin/dokter"))->with('success', 'Berhasil menghapus dokter!');
    }


    public function detail_jadwal($dokter_id = -1) {
        $dokterModel = new DokterModel();
        $dokter = $dokterModel->getDetailDokterOwnInstansi($dokter_id, $this->user['id']);
        if(!$dokter)
            return redirect()->to(site_url("admin/dokter"))->with('error', 'Dokter tidak tersedia!');
        return view('master/detail_jadwal_dokter',[
            'title' => "Detail Jadwal ".$dokter['nama'],
            'user' => $this->user,
            'dokter' => $dokter
        ]);
    }

    public function add_jadwal() {
        $days = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"];
        helper(['form']);
        $rules = [
            'dokter_id' => 'required',
            'hari' => 'required|alpha_space',
            'start' => 'required|time_valid',
            'end' => 'required|time_valid'
        ];
        if(!$this->validate($rules)){
            session()->setFlashdata('error_jadwal', true);
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        if(!in_array($this->request->getVar("hari"), $days)){
            session()->setFlashdata('error_jadwal', true);
            return redirect()->back()->withInput()->with('errors', ['hari' => 'Hari tidak tersedia!']);
        }
        if((strtotime($this->request->getVar("end")) - strtotime($this->request->getVar("start"))) <= 0){
            session()->setFlashdata('error_jadwal', true);
            return redirect()->back()->withInput()->with('errors', ['end' => 'Time End harus lebih besar dari Time Start']);
        }

        $dokterModel = new DokterModel();
        $data = [
            'dokter_id' => $this->request->getVar("dokter_id"),
            'day' => $this->request->getVar("hari"),
            'time_start' => $this->request->getVar("start"),
            'time_end' => $this->request->getVar("end")
        ];
        if(!$dokterModel->addSchedule($this->request->getVar("dokter_id"), $this->user['id'], $data))
            return redirect()->back()->with('error', "Terjadi kesalahan pada database!"); 
        return redirect()->back()->with('success', "Berhasil menambah jadwal dokter!"); 
    }

    public function edit_jadwal() {
        $days = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"];
        helper(['form']);
        $rules = [
            'dokter_id' => 'required',
            'hari' => 'required',
            'jadwal_id' => 'required',
            'start' => 'required|time_valid',
            'end' => 'required|time_valid'
        ];
        if(!$this->validate($rules)){
            session()->setFlashdata('error_edit_jadwal', true);
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        if(!in_array($this->request->getVar("hari"), $days)){
            session()->setFlashdata('error_edit_jadwal', true);
            return redirect()->back()->withInput()->with('errors', ['hari' => 'Hari tidak tersedia!']);
        }
        if((strtotime($this->request->getVar("end")) - strtotime($this->request->getVar("start"))) <= 0){
            session()->setFlashdata('error_edit_jadwal', true);
            return redirect()->back()->withInput()->with('errors', ['end' => 'Time End harus lebih besar dari Time Start']);
        }

        $dokterModel = new DokterModel();
        $data = [
            'time_start' => $this->request->getVar("start"),
            'time_end' => $this->request->getVar("end")
        ];
        if(!$dokterModel->editOwnSchedule($this->request->getVar("jadwal_id"), $this->request->getVar("dokter_id"), $this->user['id'], $data))
            return redirect()->back()->with('error', "Terjadi kesalahan pada database!"); 
        return redirect()->back()->with('success', "Berhasil merubah jadwal dokter!"); 
    }

    public function jadwal_delete($id = -1, $did = -1) {
        if($id == -1 || $did == -1 )
            return redirect()->back()->withInput()->with('error', "Jadwal/Dokter tidak boleh kosong!");
        $dokterModel = new DokterModel();
        if(!$dokterModel->deleteOwnSchedule($id, $did, $this->user['id']))
            return redirect()->back()->withInput()->with('error', "Terjadi kesalahan pada database!"); 
        return redirect()->back()->with('success', "Berhasil menghapus jadwal dokter!"); 
    }
}