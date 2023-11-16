<?php

namespace App\Controllers\Guru;

use App\Controllers\BaseController;
use App\Models\GuruModel;
use App\Models\SiswaModel;
use App\Models\KelasRombelWalasModel;

class Home extends BaseController
{
    protected $helpers = ['guru'];
    public function index()
    {
        $guruModel = new GuruModel;
        $mRombel = new KelasRombelWalasModel;
        $data = ['title'=> 'Home',
        'filter_rombel'=> $mRombel->ListOfRombelWalas(),
        'history_walas'=> $guruModel->HistoryWalas(TeacherLogin()->id)
    ];
        return view('Guru/Home', $data);
    }

    public function CariSiswa()
    {
       if ($this->request->isAJAX()) {
        $key = $this->request->getPost('key');
        $siswaModel = new SiswaModel;
        $data = ['result'=> $siswaModel->CariDataSiswa($key) ];
        $msg = ['view'=> view('Guru/Student/SearchResult', $data)];
        echo json_encode($msg);
       
       }
    }

    public function CariSiswaRombel()
    {
        
        if ($this->request->isAJAX()) {
            $rombel = $this->request->getPost('rombel');
            $siswaModel = new SiswaModel;
            $data = ['result'=> $siswaModel->SiswaByRombelId($rombel) ];
            $msg = ['view'=> view('Guru/Student/SearchResult', $data)];
            echo json_encode($msg);
           
           }
    }





    function Logout()
    {
    session()->remove('teach_sess');
    return redirect()->to(base_url('auth'));
        
    }
}
