<?php

namespace App\Controllers\Guru;

use App\Controllers\BaseController;
use App\Models\PelanggaranItemModel;
use App\Models\SiswaKelasModel;
use App\Models\PelanggaranSiswaModel;
use App\Models\KelasRombelWalasModel;

class Pelanggaran extends BaseController
{
    protected $helpers = ['guru'];
    public function index()
    {
        //
    }

    public function DetailPelanggaran($siswa_kelas_id)
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


       return view('Guru/Pelanggaran/DetailPelanggaran', $data);
    }

    public function FormPelanggaran()
    {
       if ($this->request->isAJAX()) {
        $mItemPelanggaran = new PelanggaranItemModel;
        $mSiswaKelas = new SiswaKelasModel;
        $siswa_kelas_id = $this->request->getVar('siswa_kelas_id');

        $data = [
            'siswa'=> $mSiswaKelas->SiswaKelasId($siswa_kelas_id),
            'jenis_pelanggaran'=> $mItemPelanggaran->JenisPelanggaran(),
            'item'=> $mItemPelanggaran->findAll()];

        $msg = ['view'=> view('Guru/Pelanggaran/FormPelanggaran', $data)];

        echo json_encode($msg);
       
       }
    }
    public function FormEditPelanggaran()
    {
       if ($this->request->isAJAX()) {
        $mItemPelanggaran = new PelanggaranItemModel;
        $mSiswaKelas = new SiswaKelasModel;
        $mPelanggaran = new PelanggaranSiswaModel;
        $id = $this->request->getVar('id');
        $data_pelanggaran = $mPelanggaran->find($id);
        $siswa_kelas_id = $data_pelanggaran['siswa_kelas_id'];

        $data = [
            'siswa'=> $mSiswaKelas->SiswaKelasId($siswa_kelas_id),
            'jenis_pelanggaran'=> $mItemPelanggaran->JenisPelanggaran(),
            'pelanggaran_id'=> $mItemPelanggaran->find($data_pelanggaran['pelanggaran_id']),
            'data_pelanggaran'=> $data_pelanggaran,
            'item'=> $mItemPelanggaran->findAll()];

        $msg = ['view'=> view('Guru/Pelanggaran/FormEditPelanggaran', $data)];

        echo json_encode($msg);
       
       }
    }


    public function SimpanPelanggaran()
    {
       if ($this->request->isAJAX()) {
        $this->validate= \Config\Services::validation();
        $validate = $this->validate(
            [
            'periode_langgar_id' => [
            'label'  => 'Periode',
            'rules'  => 'required',
            'errors' => [
            'required' => '{field} Belum di atur oleh admin'
            ]
            ],
            'user_created_id' => [
            'label'  => 'User Aktif',
            'rules'  => 'required',
            'errors' => [
            'required' => '{field} Tidak Terdeteksi'
            ]
            ],
            'siswa_kelas_id' => [
            'label'  => 'Identitas Siswa',
            'rules'  => 'required',
            'errors' => [
            'required' => '{field} Tidak Terdeteksi'
            ]
            ],
            'tgl_kejadian' => [
            'label'  => 'Tanggal Kejadian',
            'rules'  => 'required',
            'errors' => [
            'required' => '{field} Harus di isi ya'
            ]
            ],
            'pelanggaran_id' => [
            'label'  => 'Nama Pelanggaran',
            'rules'  => 'required',
            'errors' => [
            'required' => '{field} Harus di isi ya'
            ]
            ],
            'jenis_pelanggaran' => [
            'label'  => 'Jenis Pelanggaran',
            'rules'  => 'required',
            'errors' => [
            'required' => '{field} Harus di isi ya'
            ]
            ]
            
        ]
        );

        if (!$validate) {
            $msg = [
            'error' => [
            'periode_langgar_id' => $this->validate->getError('periode_langgar_id'),
            'user_created_id' => $this->validate->getError('user_created_id'),
            'siswa_kelas_id' => $this->validate->getError('siswa_kelas_id'),
            'tgl_kejadian' => $this->validate->getError('tgl_kejadian'),
            'pelanggaran_id' => $this->validate->getError('pelanggaran_id'),
            'jenis_pelanggaran' => $this->validate->getError('jenis_pelanggaran')
            ]
            ];
        }else{
            $id= $this->request->getPost('id');
            $data =[
                'id'=> $id == 0 ? 0 : $id,
                'periode_langgar_id'=> $this->request->getPost('periode_langgar_id'),
                'user_created_id'=> $this->request->getPost('user_created_id'),
                'siswa_kelas_id'=> $this->request->getPost('siswa_kelas_id'),
                'pelanggaran_id'=> $this->request->getPost('pelanggaran_id'),
                'bukti_pelanggaran'=> null,
                'status_tindak_lanjut'=> null,
                'keterangan'=> $this->request->getPost('keterangan'),
                'tgl_kejadian'=> $this->request->getPost('tgl_kejadian')
            ];
            
            $mPelanggaran = new PelanggaranSiswaModel;
            $mPelanggaran->save($data);
            $msg = ['sukses'=> 201];
        }
     
        echo json_encode($msg);
       
       }
    }

    



}
