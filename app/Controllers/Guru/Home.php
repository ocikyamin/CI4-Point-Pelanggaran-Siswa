<?php

namespace App\Controllers\Guru;

use App\Controllers\BaseController;
use App\Models\GuruModel;
use App\Models\SiswaModel;
use App\Models\KelasRombelModel;
use App\Models\PelanggaranSiswaModel;
class Home extends BaseController
{
    protected $helpers = ['guru'];
    public function index()
    {
        $guruModel = new GuruModel;
        $mRombel = new KelasRombelModel;
        
        if (PeriodeAktif()) {
            $periode = PeriodeAktif()->id;
        }else{
            $periode = null;
        }
        $data = ['title'=> 'Home',
        'filter_rombel'=> $mRombel->where('periode_id', $periode)->findAll(),
        // 'history_walas'=> $guruModel->HistoryWalas(TeacherLogin()->id)
    ];
        return view('Guru/Home', $data);
    }

    public function CariSiswa()
    {
       if ($this->request->isAJAX()) {
        $siswaModel = new SiswaModel;
        $this->validate= \Config\Services::validation();
            $validate = $this->validate(
            [
            'key' => [
            'label'  => 'Kata Kunci',
            'rules'  => 'required',
            'errors' => [
            'required' => '{field} Belum diisi.'
            ]
            ],
            'filter' => [
            'label'  => 'Filter',
            'rules'  => 'required',
            'errors' => [
            'required' => '{field} Belum dipilih'
            ]
            ]
            ]
            );
    
            if (!$validate) {
                $msg = [
                'status' => false,
                'key' => $this->validate->getError('key'),
                'filter' => $this->validate->getError('filter')
                ];
            }else{
                $keyword = $this->request->getPost('key');
                $filter = $this->request->getPost('filter');

                // tampilkan by filter
                if ($filter=='nisn') {
                    # cari dengan NISN
                    $data_siswa = $siswaModel->CariDataSiswa($filter, $keyword);
                }else{
                    // by nama
                    $data_siswa = $siswaModel->CariDataSiswa($filter, $keyword);

                }
                $data = ['result'=> $data_siswa];
                $msg = ['view'=> view('Guru/Student/SearchResult', $data)];       
            }
        echo json_encode($msg);
       
       }
    }

    public function CariSiswaRombel()
    { 
        if ($this->request->isAJAX()) {
            $rombel = $this->request->getPost('rombel');
            $siswaModel = new SiswaModel;
            $data = ['result'=> $siswaModel->SiswaByRombelId($rombel)];
            $msg = ['view'=> view('Guru/Student/SearchResult', $data)];
            echo json_encode($msg);
           
           }
    }
    // Notif
    public function ListNotif()
    { 
        if ($this->request->isAJAX()) {
            $rombel = $this->request->getPost('rombel');
            $siswaModel = new SiswaModel;
            $data = ['result'=> $siswaModel->SiswaByRombelId($rombel)];
            $msg = ['view'=> view('Guru/Student/SearchResult', $data)];
            echo json_encode($msg);
           
           }
    }
    public function Notif()
    { 
        $langgarM = new PelanggaranSiswaModel();
        $data = [
            'title'=> 'Notif',
            'list'=> $langgarM->NotifList(TeacherLogin()->jabatan_id),
        ];
        return view('Guru/Notif/index', $data);
    }





    function Logout()
    {
    session()->remove('teach_sess');
    return redirect()->to(base_url('auth'));
        
    }
}
