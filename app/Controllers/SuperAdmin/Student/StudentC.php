<?php

namespace App\Controllers\SuperAdmin\Student;

use App\Controllers\BaseController;
use App\Models\SekolahModel;
use App\Models\KelasLevelModel;
use App\Models\SiswaModel;
use App\Models\KelasRombelWalasModel;
use App\Models\PelanggaranSiswaModel;

class StudentC extends BaseController
{
    protected $helpers = ['master'];
    public function index()
    {
        //
    }

    public function BySekolahId($sekolah_id)
    {
        $sekolahM = new SekolahModel;
        $kelasLevelM = new KelasLevelModel;

        $data = [
            'title'=> 'Student',
            'sekolah'=> $sekolahM->find($sekolah_id),
            'level'=> $kelasLevelM->LevelBySekolahId($sekolah_id)

    ];
        return view('SuperAdmin/Student/student_by_sekolah', $data);
    }


    public function ByRombel()
    {
        if ($this->request->isAJAX()) {
            $rombel_id = $this->request->getVar('rombelid');
            $siswaRombelM = new SiswaModel;
            $infoKelasM = new KelasRombelWalasModel;
            $pelanggranM = new PelanggaranSiswaModel;

            $data = [
                'kelas'=> $infoKelasM->InfoRombelWalas($rombel_id),
                'siswa_melanggar'=> $pelanggranM->JumlahSiswaMelanggarByKelasID($rombel_id),
                'siswa'=> $siswaRombelM->SiswaByRombelId($rombel_id)];

            $msg = ['table_rombel_siswa'=> view('SuperAdmin/Student/student_by_rombel', $data)];
            echo json_encode($msg);
           
        }
    }

   
}
