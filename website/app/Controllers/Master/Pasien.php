<?php

namespace App\Controllers\Master;
use CodeIgniter\API\ResponseTrait;
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

    use ResponseTrait;
    public function keuangan($id = -1) {
        if($this->user['role'] != 1)
            return $this->setResponseFormat('json')->respond([
                'message' => "Only admin role",
                'data' => []
            ], 403);
        
        $model = new UserModel();
        $data = $model->getProyeksiKeuangan($id);
        return $this->setResponseFormat('json')->respond([
            'message' => "ok",
            'data' => $data
        ], 200);
    }

    public function topup() {
        helper(['form']);
        $rules = [
            'balance' => 'required|numeric',
            'id' => 'required|is_not_unique[users.id]',
        ];
        if(!$this->validate($rules))
            return redirect()->back()->withInput()->with('error', "Form tidak boleh kosong!");
        $model = new UserModel();
        if(!$model->topupPasien($this->request->getVar("id"),$this->request->getVar("balance")))
            return redirect()->back()->withInput()->with('error', "Gagal melakukan topup!"); 
        
        return redirect()->back()->withInput()->with('success', "Topup berhasil!");
    }

    public function tambah()
    {
        return view('master/tambah_pasien',[
            'title' => "Tambah Pasien",
            'user' => $this->user
        ]);
    }

    public function add() {
        helper(['form']);
        $rules = [
            'nama' => 'required|alpha_space',
            'email' => 'required|valid_email|is_unique[users.email]',
            'birthday' => 'required|date_valid',
            'address' => 'required',
            'password' => 'required|min_length[6]',
            'password2' => 'required|matches[password]'
        ];

        if(!$this->validate($rules))
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        
        $email = $this->request->getVar("email");
        $uname = explode("@", $email)[0].rand(000,999);
        $data = [
            'fullname' => $this->request->getVar("nama"),
            'email' => $email,
            'username' => $uname,
            'birthday' => $this->request->getVar("birthday"),
            'address' => $this->request->getVar("address"),
            'active' => 1,
            'status' => 1,
            'password_hash' => password_hash($this->request->getVar("password2"), PASSWORD_BCRYPT),
        ];
        $model = new UserModel();
        if(!$model->createAccount($data))
            return redirect()->back()->withInput()->with('error', "Terjadi kesalahan pada database!");

        return redirect()->to(site_url("admin/pasien"))->with('success', 'Berhasil menambah pasien!');
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
        return redirect()->to(site_url("admin/pasien"))->with('success', 'Berhasil merubah data pasien!');
    }

    public function delete($id = -1){ 
        if($id == -1)
            return redirect()->back()->withInput()->with('error', "Pasien tidak boleh kosong!");
        $model = new UserModel();
        if(!$model->delete($id))
            return redirect()->back()->withInput()->with('error', "Terjadi kesalahan pada database!"); 
        return redirect()->to(site_url("admin/pasien"))->with('success', 'Berhasil menghapus pasien!');
    }
}