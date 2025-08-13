<?php

namespace App\Controllers\Guru;

use App\Controllers\BaseController;
use App\Models\KelasRombelModel;
use App\Models\PelanggaranSiswaModel;
use App\Models\SiswaKelasModel;


class Walas extends BaseController
{
    protected $helpers = ['guru'];
    function __construct() {
        $this->kelasM = New KelasRombelModel();
        $this->LanggarM = New PelanggaranSiswaModel();
        $this->siswaRombelM = new SiswaKelasModel();
    }
    public function index()
    {
        $kelasKu = $this->kelasM->select('
        tm_kelas_rombel.id,
        periode.nm_periode,
        periode.status_periode,
        tm_kelas_level.level_kelas,
        tm_kelas_rombel.rombel
        ')
        ->join('periode','tm_kelas_rombel.periode_id=periode.id')
        ->join('tm_kelas_level','tm_kelas_rombel.level_kelas_id=tm_kelas_level.id')
        ->where('tm_kelas_rombel.guru_id', TeacherLogin()->id)->findAll();

        $data = [
            'title'=> 'Student List',
            'walas'=> $kelasKu,
    ];
        return view('Guru/Walas/index', $data);
    }
    function Kelas($id) {
        $rombel = $this->kelasM->InfoRombel($id);
        $data = [
            'title'=> 'Kelas Detail',
            'rombel'=>$rombel,
            'jml_siswa_langgar'=> $this->LanggarM->JumlahSiswaMelanggarByKelasID($rombel->periode_id, $rombel->semester_id,$id),
            'pelanggaran_kelas'=> $this->LanggarM ->PelanggaranByKelasId($rombel->periode_id, $rombel->semester_id,$id),
            'siswa'=> $this->siswaRombelM->SiswaByRombel($id)
    ];
    // dd($rombel);
        return view('Guru/Walas/Kelas', $data);
        
    }
}
