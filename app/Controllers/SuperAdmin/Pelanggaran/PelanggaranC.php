<?php

namespace App\Controllers\SuperAdmin\Pelanggaran;

use App\Controllers\BaseController;
use App\Models\KelasLevelModel;
use App\Models\PelanggaranSiswaModel;
use App\Models\KelasRombelModel;

class PelanggaranC extends BaseController
{
    function __construct()  {
        $this->LanggarM = New PelanggaranSiswaModel();
        $this->rombelM = new KelasRombelModel();
    }
    protected $helpers = ['master','eskul'];
    public function index()
    {
        $levelM = new KelasLevelModel;
        
        $data = ['title'=> 'Pelanggaran',
        'level'=> $levelM->findAll()
    ];
    return view('SuperAdmin/Pelanggaran/index', $data);
}


public function DetailPelanggaran()
{

    if ($this->request->isAJAX()) {

        $siswa_kelas_id = $this->request->getVar('id');
       $data = [
        'title'=> 'Pelanggaran Siswa',
        'kelas'=> $this->rombelM->DetailInfoRombelWalas($siswa_kelas_id),
        'pelanggaran'=>$this->LanggarM->PelanggaranBySiswaKelasId($siswa_kelas_id)
    ];
    $view = ['view'=> view('Guru/Pelanggaran/DetailPelanggaran', $data) ];
    echo json_encode($view);
    }
    
}
public function PelanggaranNews()
{
    if ($this->request->isAJAX()) {
         
            $data = ['news'=> $this->LanggarM ->NewsPelanggaran()];
            $msg = ['new_pelanggaran'=>view('SuperAdmin/Pelanggaran/news', $data)];
            echo json_encode($msg);
        }
    }

    function InfoPelanggaran() {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
        $data = [
            'd'=> $this->LanggarM->InfoPelanggaran($id)];
            $view = ['view'=> view('SuperAdmin/Pelanggaran/Info', $data) ];
            echo json_encode($view);
        }

        
    }



public function PelanggaranByKelas()
{
if ($this->request->isAJAX()) {
    $periode_id = $this->request->getVar('periode');
    $semester_id = $this->request->getVar('semester');
    $rombel_id = $this->request->getVar('rombel');


$data = [
    'rombel'=> $this->rombelM->InfoRombel($rombel_id),
    'jml_siswa_langgar'=> $this->LanggarM->JumlahSiswaMelanggarByKelasID($periode_id, $semester_id,$rombel_id),
    'pelanggaran_kelas'=> $this->LanggarM ->PelanggaranByKelasId($periode_id, $semester_id,$rombel_id)];
$msg = ['pelanggaran_by_rombel'=>view('SuperAdmin/Pelanggaran/kelas', $data)];
echo json_encode($msg);
}
}

public function PelanggaranKelasAll()
{
if ($this->request->isAJAX()) {
    // $periode_id = $this->request->getVar('periode');
    // $semester_id = $this->request->getVar('semester');
    $rombel_id = $this->request->getVar('rombel');


$data = [
    // 'rombel'=> $this->rombelM->InfoRombel($rombel_id),
    // 'jml_siswa_langgar'=> $this->LanggarM->JumlahSiswaMelanggarByKelasID($periode_id, $semester_id,$rombel_id),
    'pelanggaran_kelas'=> $this->LanggarM->PelanggaranByKelasId("","",$rombel_id)];
$msg = ['pelanggaran_rombel'=>view('SuperAdmin/Pelanggaran/kelas_all', $data)];
echo json_encode($msg);
}
}
// public function PelanggaranByTanggal()
// {
// if ($this->request->isAJAX()) {
// $tanggal = $this->request->getVar('tanggal');

// $data = ['pelanggaran_tanggal'=> $this->LanggarM->ByTanggal($tanggal)];
// $msg = ['pelanggaran_by_tanggal'=>view('SuperAdmin/Pelanggaran/tanggal', $data)];
// echo json_encode($msg);
// }
// }


// Controller: PelanggaranSiswaController.php
public function GrafikPelanggaran()
{
    $periode_langgar_id = $this->request->getGet('periode_langgar_id');

    // Query untuk mengambil data pelanggaran berdasarkan periode_langgar_id
    $query = $this->LanggarM
                      ->select('tm_kelas_rombel.rombel, COUNT(pelanggaran_siswa.id) as jumlah_pelanggaran')
                      ->join('m_siswa_kelas', 'pelanggaran_siswa.siswa_kelas_id = m_siswa_kelas.id')
                      ->join('tm_kelas_rombel', 'm_siswa_kelas.rombel_id = tm_kelas_rombel.id')
                      ->where('pelanggaran_siswa.periode_langgar_id', $periode_langgar_id)
                      ->groupBy('tm_kelas_rombel.rombel')
                      ->get();

    $data = $query->getResult();

    $labels = [];
    $values = [];

    foreach ($data as $row) {
        $labels[] = $row->rombel;
        $values[] = $row->jumlah_pelanggaran;
    }

    return $this->response->setJSON([
        'labels' => $labels,
        'values' => $values
    ]);
}


}
