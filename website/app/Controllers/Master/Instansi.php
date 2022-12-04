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

    public function tambah()
    {
        $model = new UserModel();
        return view('master/tambah_instansi',[
            'title' => "Tambah Instansi",
            'user' => $this->user
        ]);
    }

    public function add() {
        helper(['form']);
        $rules = [
            'nama' => 'required|alpha_space',
            'username' => 'required|is_unique[users.username]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'birthday' => 'required|date_valid',
            'address' => 'required',
            'password' => 'required|min_length[6]',
            'password2' => 'required|matches[password]'
        ];

        if(!$this->validate($rules))
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        $data = [
            'fullname' => $this->request->getVar("nama"),
            'email' => $this->request->getVar("email"),
            'username' => $this->request->getVar("username"),
            'birthday' => $this->request->getVar("birthday"),
            'address' => $this->request->getVar("address"),
            'active' => 1,
            'status' =>1,
            'password_hash' => password_hash($this->request->getVar("password2"), PASSWORD_BCRYPT),
        ];
        $model = new UserModel();
        if(!$model->createInstansi($data))
            return redirect()->back()->withInput()->with('error', "Terjadi kesalahan pada database!");

        return redirect()->to(site_url("admin/instansi"))->with('success', 'Berhasil menambah instansi!');
    }

    public function edit() {
        helper(['form']);
        $rules = [
            'id' => 'required',
            'nama' => 'required|alpha_space',
            'status' => 'required|numeric',
            'active' => 'required|numeric',
        ];
        if(!$this->validate($rules))
            return redirect()->back()->withInput()->with('error', "Gagal! Harap isi form dengan benar.");
        
        $data = [
            'fullname' => $this->request->getVar("nama"),
            'status' => $this->request->getVar("status"),
            'active' => $this->request->getVar("active")
        ];
        if($this->request->getVar("password"))
            $data['password_hash'] = password_hash($this->request->getVar("password"), PASSWORD_BCRYPT);
        $model = new UserModel();

        if(!$model->protect(false)->update($this->request->getVar("id"), $data))
            return redirect()->back()->withInput()->with('error', "Terjadi kesalahan pada database!");
        return redirect()->to(site_url("admin/instansi"))->with('success', 'Berhasil merubah data instansi!');
    }

    public function delete($id = -1){ 
        if($id == -1)
            return redirect()->back()->withInput()->with('error', "Instansi tidak boleh kosong!");
        $model = new UserModel();
        if(!$model->delete($id))
            return redirect()->back()->withInput()->with('error', "Terjadi kesalahan pada database!"); 
        return redirect()->to(site_url("admin/instansi"))->with('success', 'Berhasil menghapus instansi!');
    }
}