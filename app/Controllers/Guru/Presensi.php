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

    public function PresensiKelas($kelas_mengajar_id)
    {
        $kelasM = new KelasMengajarModel;
        $kelas = $kelasM->InfoKelasMengajar($kelas_mengajar_id);
        $data = [
        'title'=> 'Presensi',
        'kelas_mengajar_id'=> $kelas_mengajar_id,
        'kelas'=> $kelas
        ];
        return view('Guru/Presensi/Kelas', $data);

      

    }

    public function RekapPresensiKelas()
    {
        if ($this->request->isAJAX()) {
            $kelas_mengajar_id = $this->request->getVar('kelas_mengajar_id');
            $kelasM = new KelasMengajarModel;
            $siswaM = new SiswaModel;
            $kelas = $kelasM->InfoKelasMengajar($kelas_mengajar_id);
            $tanggal_pertemuan = StatusPertemuan($kelas_mengajar_id);
            $data = [
            'kelas'=> $kelas,
            'siswa'=> $siswaM ->SiswaNamaRombelId($kelas->rombel_walas_id),
            'jml'=> count($tanggal_pertemuan),
            'tanggal_pertemuan'=> $tanggal_pertemuan,
            'kelas_mengajar_id'=> $kelas_mengajar_id
            ];
            $view = ['rekap'=> view('Guru/Presensi/Rekap', $data)];
            echo json_encode($view);
           }
    }
    public function FormPresensiKelas()
    {
        if ($this->request->isAJAX()) {
            $kelas_mengajar_id = $this->request->getVar('kelas_mengajar_id');
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
                $data_input = [
                    'tanggal' => $request['tanggal'],
                    'mapel_mengajar_id' => $request['mapel_mengajar_id'],
                    'pertemuan_ke' => $request['pertemuan_ke'],
                ];
                    // Lakukan validasi di dalam model dan tangkap pesan error jika ada
                    $validationError = $presensiModel->checkData($data_input);
                    
                    if ($validationError !== null) {
                        // Jika ada pesan error dari validasi, tampilkan pesan tersebut
                        // return redirect()->back()->withInput()->with('error', $validationError);
                    $response = [
                        'error' => ['sudah'=> $validationError]
                    ];
                    } else {
                        // Jika tidak ada pesan error, simpan data

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
                        $presensiModel->insertBatch($dataToInsert);
                        $response = [
                        'sukses' => 201,'msg' => 'Data Kehadiran untuk Tanggal '.date('d/M/Y', strtotime($tanggal)). ' Berhasil disimpan.'];
                        }

                 
                   
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
        
                echo json_encode($response);
            }
            
    }
    public function EditPresensiKelas(){
        if ($this->request->isAJAX()) {
            $kelas_mengajar_id= $this->request->getVar('kelas_mengajar_id');
            $pertemuan_ke= $this->request->getVar('pertemuan_ke');
            $kelasM = new KelasMengajarModel;
            $presensiModel = new PresensiModel;
            $kelas = $kelasM->InfoKelasMengajar($kelas_mengajar_id);
                $pertemuan = GetPertemuanKe($kelas_mengajar_id,$pertemuan_ke);
                    $data = [
                    'siswa'=> $presensiModel->GetSiswaPresensiPertemuan($kelas_mengajar_id,$pertemuan_ke),
                    'pertemuan'=> $pertemuan
                    ];
            
                    $view = ['edit'=> view('Guru/Presensi/Edit', $data)];
                    echo json_encode($view);
                }
            }

            public function UpdatePresensiKelas()
            {

                if ($this->request->isAJAX()) {
                    $presensiData = $this->request->getVar('presensi');
                    $ketData = $this->request->getVar('ket');
    
                    // Perform batch update
                    if ($presensiData && $ketData) {
                    $dataToUpdate = [];
                    foreach ($presensiData as $index => $presensiId) {
                        $dataToUpdate[] = [
                        'id' => $presensiId,
                        'kehadiran' => $ketData[$index],
                        ];
                    }
                    $presensiModel = new PresensiModel;
                    $presensiModel->updateBatch($dataToUpdate, 'id');
                    $response = ['sukses'=> 201, 'msg'=> 'Daftar Hadir Berhasil diperbarui'];
                    
                    // Redirect to a success page or do whatever you want
                } else {
                        $response = ['error'=> 402, 'msg'=> 'Daftar Hadir Gagal diperbarui'];
                    // Handle form submission errors
                    // Redirect back to the form with error messages
                    }

                    echo json_encode($response);
                }

    
            }


            public function Delete()
            {
                if ($this->request->isAJAX()) {
                    $mapel_mengajar_id = $this->request->getPost('id');
                    $pertemuan_ke = $this->request->getPost('pertemuan');
                    $presensiModel = new PresensiModel;
                    $presensiModel->where('mapel_mengajar_id',$mapel_mengajar_id)->where('pertemuan_ke',$pertemuan_ke)->delete();
                    $response = ['status'=> 201,'msg'=> 'Data Kehadiran Telah dihapus'];
                    echo json_encode($response);

                }
                
            }
}


      

    

        
        