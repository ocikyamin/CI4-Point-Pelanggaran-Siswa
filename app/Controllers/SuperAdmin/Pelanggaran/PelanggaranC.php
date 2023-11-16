<?php

namespace App\Controllers\SuperAdmin\Pelanggaran;

use App\Controllers\BaseController;
use App\Models\KelasLevelModel;
use App\Models\PelanggaranSiswaModel;

class PelanggaranC extends BaseController
{
    protected $helpers = ['master'];
    public function index()
    {
        $levelM = new KelasLevelModel;
        
        $data = ['title'=> 'Pelanggaran',
        'level'=> $levelM->findAll()
    ];
    return view('SuperAdmin/Pelanggaran/index', $data);
}

public function PelanggaranNews()
{
    if ($this->request->isAJAX()) {
            $pelanggaranM = new PelanggaranSiswaModel;
            $data = ['news'=> $pelanggaranM->NewsPelanggaran()];
            $msg = ['new_pelanggaran'=>view('SuperAdmin/Pelanggaran/news', $data)];
            echo json_encode($msg);
        }
    }
public function PelanggaranByKelas()
{
if ($this->request->isAJAX()) {
$rombel_walas_id = $this->request->getVar('rombel_walas_id');

$pelanggaranM = new PelanggaranSiswaModel;
$data = ['pelanggaran_kelas'=> $pelanggaranM->PelanggaranByKelasId($rombel_walas_id)];
$msg = ['new_pelanggaran'=>view('SuperAdmin/Pelanggaran/kelas', $data)];
echo json_encode($msg);
}
}
public function PelanggaranByTanggal()
{
if ($this->request->isAJAX()) {
$tanggal = $this->request->getVar('tanggal');

$pelanggaranM = new PelanggaranSiswaModel;
$data = ['pelanggaran_tanggal'=> $pelanggaranM->ByTanggal($tanggal)];
$msg = ['pelanggaran_by_tanggal'=>view('SuperAdmin/Pelanggaran/tanggal', $data)];
echo json_encode($msg);
}
}




}
