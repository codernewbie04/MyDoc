<?php

namespace App\Controllers\Api\V1\Master;
use App\Controllers\Api\V1\BaseResponse;
use App\Models\DokterModel;

class Dokter extends BaseResponse
{
    public function index(){
        $model = new DokterModel();
        return $this->response("Berhasil mendapatkan data!", $model->getDokterAndInstansi(), 200); 
    }

    public function detail($id = 0){
        $model = new DokterModel();
        $dokter = $model->getDetailDokter($id);
        if(!$dokter)
            return $this->response("Dokter tidak tersedia!", null, 404);
        
        return $this->response("Berhasil mendapatkan data!", $dokter, 200); 
    }
}