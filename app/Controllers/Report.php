<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\PelanggaranSiswaModel;
use App\Models\KelasRombelModel;
use App\Models\KelasMengajarModel;
use App\Models\SiswaModel;
use App\Models\Jurnal\AgendaModel;

class Report extends BaseController
{
    protected $helpers = ['presensi'];
    public function index()
    {
        //
    }

    public function PelanggaranSiswaId($siswa_kelas_id)
    {
        $mInfoKelas = new KelasRombelModel;
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
        $infoKelasM = new KelasRombelModel;
        $mPelanggaran = new PelanggaranSiswaModel;

        $data = [
            'title'=> 'Pelanggaran Siswa Kelas',
            'kelas'=> $infoKelasM->InfoRombelWalas($rombel_id),
            'siswa_melanggar'=> $mPelanggaran->PelanggaranByKelasId($rombel_id)
        ];
        return view('Report/print_pelanggaran_kelas_id', $data);
    }

    public function PresensiByKelasMengajar($jadwal_id)
    {
        $infoKelasM = new KelasRombelModel;
        $kelasM = new KelasMengajarModel;
        $siswaM = new SiswaModel;
        $agendaM = new AgendaModel();
        $kelas = $kelasM->InfoKelasMengajar($jadwal_id);

        
        // $data = [
            // 'kelas'=> $kelas,
            // 'siswa'=> $siswaM ->SiswaNamaRombelId($kelas->rombel_walas_id),
            // 'jml'=> count($tanggal_pertemuan),
            // 'tanggal_pertemuan'=> $tanggal_pertemuan,
            // 'last'=> StatusPresensiToday($kelas->id),
            // 'kelas_mengajar_id'=> $kelas_mengajar_id,
            // 'walas'=> $infoKelasM->InfoRombel($kelas->rombel_walas_id)
            // ];
            
            $data = [
                'rombel_id'=> $kelas->rombel_walas_id,
                'jadwal_id'=> $kelas->id,
                'kelas'=> $infoKelasM->InfoRombel($kelas->rombel_walas_id),
                'jadwal'=> $kelas,
                'pertemuan'=> $agendaM->select('id,pertemuan,tgl_pertemuan')->where('kelas_mengajar_id', $kelas->id)->findAll(),
                'siswa'=>$siswaM ->SiswaNamaRombelId($kelas->rombel_walas_id)
            ];
            
            // dd($data);
       return view('Report/print_presensi_kelas_mengajar', $data);
    }
}
