<?php

namespace App\Controllers\Guru;

use App\Controllers\BaseController;
use App\Models\TingkatSekolahModel;
use App\Models\KelasRombelWalasModel;
use App\Models\GuruModel;

class Setting extends BaseController
{
    protected $helpers = ['guru'];
    public function index()
    {
        //
    }
    public function SettingKelas()
    {
        if ($this->request->isAJAX()) {
            $sekolah = new TingkatSekolahModel;
            $data = ['sekolah'=> $sekolah->findAll(),
            'guru_id'=> $this->request->getVar('guruid')
        ];
            $msg = ['view'=> view('Guru/Setting/PengaturanKelas', $data)];
            
            echo json_encode($msg);
        }
    }

    public function SimpanSettingKelas()
    {
        if ($this->request->isAJAX()) {
            $this->validate= \Config\Services::validation();
            $validate = $this->validate(
                [
                'sekolah_id' => [
                'label'  => 'Tingkat Sekolah',
                'rules'  => 'required',
                'errors' => [
                'required' => '{field} Harus dipilih'
                ]
                ],
                'level_kelas_id' => [
                'label'  => 'Tingkat Kelas',
                'rules'  => 'required',
                'errors' => [
                'required' => '{field} Harus dipilih'
                ]
                ],
                'kelas_rombel_id' => [
                'label'  => 'Rombel',
                'rules'  => 'required|is_unique[tm_kelas_rombel_walas.rombel_id]',
                'errors' => [
                'required' => '{field} Harus dipilih',
                'is_unique' => 'Guru Kelas Untuk Kelas ini sudah Ada. Hubungi Admin Jika ini salah.',
                ]
                ],
                'is_confirm' => [
                'label'  => 'Kolom Persetujuan',
                'rules'  => 'required',
                'errors' => [
                'required' => '{field} Harus Harus di centang'
                ]
                ]
                
            ]
            );
    
            if (!$validate) {
                $msg = [
                'error' => [
                'sekolah_id' => $this->validate->getError('sekolah_id'),
                'level_kelas_id' => $this->validate->getError('level_kelas_id'),
                'kelas_rombel_id' => $this->validate->getError('kelas_rombel_id'),
                'is_confirm' => $this->validate->getError('is_confirm')
                ]
                ];
            }else{
                $periode_id = $this->request->getPost('periode_id');
                $guru_id = $this->request->getPost('guru_id');
                $sekolah_id = $this->request->getPost('sekolah_id');
                $level_kelas_id = $this->request->getPost('level_kelas_id');
                $kelas_rombel_id = $this->request->getPost('kelas_rombel_id');
                $is_confirm = $this->request->getPost('is_confirm');

                $mrombelWalas = new KelasRombelWalasModel;
                // Cek Apakah Walas sudah ada 
                $cekWalas = $mrombelWalas->CheckWalas($periode_id,$kelas_rombel_id,$guru_id);
                if ($cekWalas) {
                    $msg = [
                        'error' => [
                        'kelas_rombel_id' => 'Sudah ada Wali Kelas untuk Rombel ini'
                        ]
                        ];
                }else{
                $data = [
                    'periode_id'=> $periode_id,
                    'rombel_id'=> $kelas_rombel_id,
                    'guru_id'=> $guru_id,
                    'status_walas'=> $is_confirm
                ];
                $simpanWalas = $mrombelWalas->save($data);
                $msg = ['sukses'=> 200];
                }
                              


            }


            echo json_encode($msg);
        }
    }

    public function RemoveTypeAkun()
    {
        if ($this->request->isAJAX()) {
            $guruM = new GuruModel;
            $data = [
            'id'=> $this->request->getPost('guruid'),
            'type'=> 'guru'
            ];
            $guruM->save($data);
            $msg = [
                'sukses'=> 200,
                'link'=> base_url('teacher')
            ];
            echo json_encode($msg);
        }
    }


}
