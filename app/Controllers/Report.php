<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\PelanggaranSiswaModel;
use App\Models\KelasRombelWalasModel;
use App\Models\KelasMengajarModel;
use App\Models\SiswaModel;

class Report extends BaseController
{
    protected $helpers = ['presensi'];
    public function index()
    {
        //
    }

    public function PelanggaranSiswaId($siswa_kelas_id)
    {
        $mInfoKelas = new KelasRombelWalasModel;
        // DetailInfoRombelWalas($id)
        $mPelanggaran = new PelanggaranSiswaModel;
        // PelanggaranBySiswaKelasId
       $data = [
        'title'=> 'Pelanggaran Siswa',
        'kelas'=> $mInfoKelas->DetailInfoRombelWalas($siswa_kelas_id),
        'pelanggaran'=>$mPelanggaran->PelanggaranBySiswaKelasId($siswa_kelas_id)
    ];
        return view('Report/print_pelanggaran_siswa_id', $data);
    }

    public function PelanggaranSiswaKelas($rombel_id)
    {

        // $siswaRombelM = new SiswaModel;
        $infoKelasM = new KelasRombelWalasModel;
        $mPelanggaran = new PelanggaranSiswaModel;

        $data = [
            'title'=> 'Pelanggaran Siswa Kelas',
            'kelas'=> $infoKelasM->InfoRombelWalas($rombel_id),
            'siswa_melanggar'=> $mPelanggaran->PelanggaranByKelasId($rombel_id)
        ];
        return view('Report/print_pelanggaran_kelas_id', $data);
    }

    public function PresensiByKelasMengajar($kelas_mengajar_id)
    {
        $infoKelasM = new KelasRombelWalasModel;
        $kelasM = new KelasMengajarModel;
        $siswaM = new SiswaModel;
        $kelas = $kelasM->InfoKelasMengajar($kelas_mengajar_id);
        $tanggal_pertemuan = StatusPertemuan($kelas_mengajar_id);
        $data = [
        'kelas'=> $kelas,
        'siswa'=> $siswaM ->SiswaNamaRombelId($kelas->rombel_walas_id),
        'jml'=> count($tanggal_pertemuan),
        'tanggal_pertemuan'=> $tanggal_pertemuan,
        'last'=> StatusPresensiToday($kelas->id),
        'kelas_mengajar_id'=> $kelas_mengajar_id,
        'walas'=> $infoKelasM->InfoRombelWalas($kelas->rombel_walas_id)
        ];
       return view('Report/print_presensi_kelas_mengajar', $data);
    }
}
