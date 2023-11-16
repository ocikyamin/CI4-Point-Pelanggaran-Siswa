<?php

namespace App\Controllers\Guru;

use App\Controllers\BaseController;
use App\Models\KelasRombelWalasModel;
use App\Models\KelasMengajarModel;
use App\Models\SiswaModel;
use App\Models\PresensiModel;

class Presensi extends BaseController
{
    protected $helpers = ['guru','presensi'];
    public function index()
    {
        $data = ['title'=> 'Home'
    ];
        return view('Guru/Presensi/index', $data);
    }

    public function PresensiKelas($rombel_walas_id)
    {
        $kelasM = new KelasMengajarModel;
        $kelas = $kelasM->InfoKelasMengajar($rombel_walas_id);
        $data = [
        'title'=> 'Presensi',
        'rombel_walas_id'=> $rombel_walas_id,
        'kelas'=> $kelas
        ];
        return view('Guru/Presensi/Kelas', $data);

      

    }

    public function RekapPresensiKelas()
    {
        if ($this->request->isAJAX()) {
            $rombel_walas_id = $this->request->getVar('rombel_walas_id');
            $kelasM = new KelasMengajarModel;
            $siswaM = new SiswaModel;
            $kelas = $kelasM->InfoKelasMengajar($rombel_walas_id);
            $tanggal_pertemuan = StatusPertemuan($rombel_walas_id);
            $data = [
            'kelas'=> $kelas,
            'siswa'=> $siswaM ->SiswaNamaRombelId($kelas->id),
            'jml'=> count($tanggal_pertemuan),
            'tanggal_pertemuan'=> $tanggal_pertemuan
            ];
            $view = ['rekap'=> view('Guru/Presensi/Rekap', $data)];
            echo json_encode($view);
           }
    }
    public function FormPresensiKelas()
    {
        if ($this->request->isAJAX()) {
            $rombel_walas_id = $this->request->getVar('rombel_walas_id');
            $kelasM = new KelasMengajarModel;
            $siswaM = new SiswaModel;
            $kelas = $kelasM->InfoKelasMengajar($rombel_walas_id);
            $tanggal_pertemuan = StatusPertemuan($rombel_walas_id);
            $data = [
            'kelas'=> $kelas,
            'siswa'=> $siswaM ->SiswaNamaRombelId($kelas->id),
            'jml'=> count($tanggal_pertemuan),
            'tanggal_pertemuan'=> $tanggal_pertemuan,
            'last'=> StatusPresensiToday($kelas->id),
            'rombel_walas_id'=> $rombel_walas_id,
            ];
            $view = ['presensi'=> view('Guru/Presensi/Presensi', $data)];
            echo json_encode($view);
           }
    }
    public function Save()
    {
        // print_r($_POST);
        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";

        if ($this->request->isAJAX()) {
            $this->validate = \Config\Services::validation();
            $validate = $this->validate([
                'tanggal' => [
                    'label'  => 'Tanggal Pertemuan',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => '{field} Harus dipilih'
                    ]
                ],
                'jam_ke' => [
                    'label'  => 'Jam Pelajaran',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => '{field} Harus dipilih'
                    ]
                ],
                'pertemuan_ke' => [
                    'label'  => 'Pertemuan Ke-',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => '{field} Harus dipilih'
                    ]
                ],
            ]);
        
            if (!$validate) {
                $response = [
                    'error' => [
                        'tanggal' => $this->validate->getError('tanggal'),
                        'jam_ke' => $this->validate->getError('jam_ke'),
                        'pertemuan_ke' => $this->validate->getError('pertemuan_ke')
                    ]
                ];
            } else {
                // Ambil data dari form
                $request = $this->request->getPost();
                $tanggal = $request['tanggal'];
                $mapel_mengajar_id = $request['mapel_mengajar_id'];
                $siswa = $request['siswa'];
                $jam_ke = $request['jam_ke'];
                $pertemuan_ke = $request['pertemuan_ke'];
                $ket = isset($request['ket']) ? $request['ket'] : '';

                  // Lakukan validasi setiap baris untuk memastikan setiap baris memiliki setidaknya satu checkbox yang dipilih
                    $isValid = true;
                    foreach ($siswa as $index => $id_siswa) {
                    if (empty($ket[$index])) {
                    $isValid = false;
                    break;
                    }
                    }

                    if (!$isValid) {
                        // Jika setidaknya satu baris tidak valid (tidak ada checkbox yang dipilih pada baris tersebut)
                        // Kembalikan respons JSON berisi pesan error
                        $response = [
                            'error' => ['pilihan'=> 'Terdapat Keterangan Kehadiran yang belum di penuhi']
                        ];
                    }else{
                         
                // Siapkan data untuk diinsert secara batch
                $dataToInsert = [];
                // Looping untuk menyimpan data kehadiran setiap siswa berdasarkan ID siswa yang dipilih
                for ($i = 0; $i < count($siswa); $i++) {
                    $id_siswa = $siswa[$i];
                    $keterangan = isset($ket[$i]) ? $ket[$i] : ''; // Menangani ketika checkbox tidak dipilih
        
                    // Tambahkan data ke array untuk diinsert secara batch
                    $dataToInsert[] = [
                        'tanggal' => $tanggal,
                        'mapel_mengajar_id' => $mapel_mengajar_id,
                        'siswa_kelas_id' => $id_siswa,
                        'jam_ke' => $jam_ke,
                        'pertemuan_ke' => $pertemuan_ke,
                        'kehadiran' => $keterangan,
                    ];
                }

                $presensiModel = new PresensiModel;
                // Validasi data
                if ($presensiModel->checkIfExists($tanggal, $mapel_mengajar_id)) {
                // Tampilkan pesan error jika tanggal dan mapel_mengajar_id sudah ada
                // echo "Error: Tanggal dan Mapel Mengajar ID sudah ada!";
                $response = [
                    'error' => ['sudah'=> 'Tanggal dan Mapel Mengajar ID sudah ada!' ]
                ];
                } elseif ($presensiModel->checkIfExists($mapel_mengajar_id, $pertemuan_ke)) {
                // Tampilkan pesan error jika mapel_mengajar_id dan pertemuan_ke sudah ada
                // echo "Error: Mapel Mengajar ID dan Pertemuan Ke sudah ada!";
                $response = [
                    'error' => ['sudah'=> 'Mapel Mengajar ID dan Pertemuan Ke sudah ada!' ]
                ];
                } elseif ($presensiModel->checkIfExists($tanggal, $mapel_mengajar_id, $pertemuan_ke)) {
                // Tampilkan pesan error jika tanggal, mapel_mengajar_id, dan pertemuan_ke sudah ada
                // echo "Error: Data sudah ada!";
                $response = [
                    'error' => ['sudah'=> 'Data sudah ada!' ]
                ];
                }else{
                    // $response = ['sukses'=> 201];
                    $presensiModel->insertBatch($dataToInsert);
                $response = [
                    'sukses' => 201,'msg' => 'Data Kehadiran untuk Tanggal '.date('d/M/Y', strtotime($tanggal)). ' Berhasil disimpan.'];
                    
                }

                // Cek jika tangga,pertemuan sudah di isi 

        
                // if ($presensiModel->Cek($tanggal,$mapel_mengajar_id,$pertemuan_ke) > 0) {
                //     $response = [
                //         'error' => ['sudah'=> 'Daftar Hadir Untuk Tanggal '.date('d/M/Y', strtotime($tanggal)). ' Petemuan Ke- '. $pertemuan_ke.' Telah di isi. Silahkan Klik Tanggal pada Rekap Kehadiran Untuk mengubah Daftar Kehadiran' ]
                //     ];
                // }else{
                //       // Contoh: Simpan kehadiran menggunakan model dan fungsi insertBatch()
                // $presensiModel->insertBatch($dataToInsert);
                // $response = [
                //     'sukses' => 201,'msg' => 'Data Kehadiran untuk Tanggal '.date('d/M/Y', strtotime($tanggal)). ' Berhasil disimpan.'];
                // }
              
                    }
       
            }
        
            echo json_encode($response);
        }
        
    }
}
