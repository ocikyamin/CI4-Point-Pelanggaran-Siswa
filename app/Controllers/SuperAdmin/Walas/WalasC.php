<?php

namespace App\Controllers\SuperAdmin\Walas;

use App\Controllers\BaseController;
use App\Models\KelasLevelModel;
use App\Models\SiswaModel;
use App\Models\KelasRombelWalasModel;
use App\Models\PelanggaranSiswaModel;

class WalasC extends BaseController
{
    protected $helpers = ['master'];
    public function index()
    {
    $levelM = new KelasLevelModel;
      $data = [
        'title'=> 'Wali Kelas',
        'level'=> $levelM->findAll()
    ];
      return view('SuperAdmin/Walas/index', $data);

    }
    public function Detail($rombel_id)
    {
        $siswaRombelM = new SiswaModel;
        $infoKelasM = new KelasRombelWalasModel;
        $pelanggranM = new PelanggaranSiswaModel;

        $data = [
            'title'=> 'Detail Kelas',
            'kelas'=> $infoKelasM->InfoRombelWalas($rombel_id),
            'siswa_melanggar'=> $pelanggranM->JumlahSiswaMelanggarByKelasID($rombel_id),
            'siswa'=> $siswaRombelM->SiswaByRombelId($rombel_id)];

       return view('SuperAdmin/Walas/student_by_rombel', $data);
    }
}
