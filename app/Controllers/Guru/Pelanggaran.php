<?php

namespace App\Controllers\Guru;

use App\Controllers\BaseController;
use App\Models\PelanggaranItemModel;
use App\Models\SiswaKelasModel;
use App\Models\PelanggaranSiswaModel;
use App\Models\KelasRombelModel;
use App\Models\JabatanModel;

class Pelanggaran extends BaseController
{
    protected $helpers = ['guru'];
    public function index()
    {
        //
    }

    public function DetailPelanggaran()
    {
 
        if ($this->request->isAJAX()) {
            $mInfoKelas = new KelasRombelModel;
            // DetailInfoRombelWalas($id)
            $mPelanggaran = new PelanggaranSiswaModel;
            // PelanggaranBySiswaKelasId

            $siswa_kelas_id = $this->request->getVar('id');
           $data = [
            'title'=> 'Pelanggaran Siswa',
            'kelas'=> $mInfoKelas->DetailInfoRombelWalas($siswa_kelas_id),
            'pelanggaran'=>$mPelanggaran->PelanggaranBySiswaKelasId($siswa_kelas_id)
        ];
        $view = ['view'=> view('Guru/Pelanggaran/DetailPelanggaran', $data) ];
        echo json_encode($view);
        }
        
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
        $d = $mPelanggaran
        ->select('pelanggaran_siswa.*,pelanggaran_item.jenis_id,pelanggaran_item.nama_pelanggaran')
        ->join('pelanggaran_item','pelanggaran_siswa.pelanggaran_id=pelanggaran_item.id')
        ->where('pelanggaran_siswa.id', $id)->first();

        $data = [
            'siswa'=> $mSiswaKelas->SiswaKelasId($d['siswa_kelas_id']),
            'jenis_pelanggaran'=> $mItemPelanggaran->JenisPelanggaran(),
            'item'=> $mItemPelanggaran->findAll(),
            'd'=> $d,
        ];

        $msg = ['view'=> view('Guru/Pelanggaran/FormEditPelanggaran', $data)];

        echo json_encode($msg);
       
       }
    }


    public function SimpanPelanggaran()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $validationRules = [
                'periode_langgar_id' => [
                    'label'  => 'Periode',
                    'rules'  => 'required',
                    'errors' => ['required' => '{field} Belum di atur oleh admin']
                ],
                'user_created_id' => [
                    'label'  => 'User Aktif',
                    'rules'  => 'required',
                    'errors' => ['required' => '{field} Tidak Terdeteksi']
                ],
                'siswa_kelas_id' => [
                    'label'  => 'Identitas Siswa',
                    'rules'  => 'required',
                    'errors' => ['required' => '{field} Tidak Terdeteksi']
                ],
                'tgl_kejadian' => [
                    'label'  => 'Tanggal Kejadian',
                    'rules'  => 'required',
                    'errors' => ['required' => '{field} Harus di isi ya']
                ],
                'pelanggaran_id' => [
                    'label'  => 'Nama Pelanggaran',
                    'rules'  => 'required',
                    'errors' => ['required' => '{field} Harus di isi ya']
                ],
                'jenis_pelanggaran' => [
                    'label'  => 'Jenis Pelanggaran',
                    'rules'  => 'required',
                    'errors' => ['required' => '{field} Harus di isi ya']
                ],
                'status_tindak_lanjut' => [
                    'label'  => 'Status Tindak Lanjut',
                    'rules'  => 'required',
                    'errors' => ['required' => '{field} Harus di pilih']
                ],
                'lampiran' => [
                    'label' => 'Lampiran',
                    'rules' => 'if_exist|uploaded[lampiran]|mime_in[lampiran,image/jpg,image/jpeg,image/png]|max_size[lampiran,2048]',
                    'errors' => [
                        'uploaded' => 'Anda harus mengunggah lampiran jika memilih opsi ini',
                        'mime_in' => 'Lampiran harus berupa file gambar (jpg, jpeg, png)',
                        'max_size' => 'Ukuran lampiran maksimal 2MB'
                    ]
                ]
            ];

            if (!$this->validate($validationRules)) {
                $errors = $validation->getErrors();
                return $this->response->setJSON(['error' => $errors]);
            } else {
                $lampiran = $this->request->getFile('lampiran');
                $lampiranName = null;

                if ($lampiran && $lampiran->isValid() && !$lampiran->hasMoved()) {
                    $lampiranName = $lampiran->getRandomName();
                    $lampiran->move(ROOTPATH . 'uploads/lampiran/', $lampiranName);
                }

                $postData = $this->request->getPost();
                $data = [
                    'id'=> isset($postData['id']) ? $postData['id']:null,
                    'created_at' => date('Y-m-d H:i:s'),
                    'periode_langgar_id' => $postData['periode_langgar_id'],
                    'semester_langgar_id' => $postData['semester_langgar_id'],
                    'user_created_id' => $postData['user_created_id'],
                    'siswa_kelas_id' => $postData['siswa_kelas_id'],
                    'pelanggaran_id' => $postData['pelanggaran_id'],
                    // 'pelanggaran_id' => $postData['jenis_pelanggaran'],
                    'lampiran' => $lampiranName,
                    'status_tindak_lanjut' => $postData['status_tindak_lanjut'],
                    // 'keterangan' => $postData['keterangan'],
                    'tgl_kejadian' => $postData['tgl_kejadian']
                ];

                if ($postData['status_tindak_lanjut'] == "selesai") {
                    $data['tgl_penyelesaian'] = $postData['tgl_penyelesaian'];
                    $data['keterangan'] = $postData['keterangan'];
                    $data['keterangan_final'] = 'Diselesaikan Oleh '. TeacherLogin()->nm_guru;
                } elseif ($postData['status_tindak_lanjut'] == "diteruskan") {
                    $data['teruskan_ke'] = $postData['teruskan_ke'];
                    $jabatan = new JabatanModel();
                    $terusan = $jabatan->find($postData['teruskan_ke']);


                    $data['keterangan'] = TeacherLogin()->nm_guru. ' Memilih Kasus ini Diteruskan Ke '. $terusan['jabatan'];
                }

                $mPelanggaran = new PelanggaranSiswaModel;
                $mPelanggaran->save($data);
                return $this->response->setJSON(['success' => 201]);
            }
        }

      




    //    if ($this->request->isAJAX()) {
    //     $this->validate= \Config\Services::validation();
    //     $validate = $this->validate(
    //         [
    //         'periode_langgar_id' => [
    //         'label'  => 'Periode',
    //         'rules'  => 'required',
    //         'errors' => [
    //         'required' => '{field} Belum di atur oleh admin'
    //         ]
    //         ],
    //         'user_created_id' => [
    //         'label'  => 'User Aktif',
    //         'rules'  => 'required',
    //         'errors' => [
    //         'required' => '{field} Tidak Terdeteksi'
    //         ]
    //         ],
    //         'siswa_kelas_id' => [
    //         'label'  => 'Identitas Siswa',
    //         'rules'  => 'required',
    //         'errors' => [
    //         'required' => '{field} Tidak Terdeteksi'
    //         ]
    //         ],
    //         'tgl_kejadian' => [
    //         'label'  => 'Tanggal Kejadian',
    //         'rules'  => 'required',
    //         'errors' => [
    //         'required' => '{field} Harus di isi ya'
    //         ]
    //         ],
    //         'pelanggaran_id' => [
    //         'label'  => 'Nama Pelanggaran',
    //         'rules'  => 'required',
    //         'errors' => [
    //         'required' => '{field} Harus di isi ya'
    //         ]
    //         ],
    //         'jenis_pelanggaran' => [
    //         'label'  => 'Jenis Pelanggaran',
    //         'rules'  => 'required',
    //         'errors' => [
    //         'required' => '{field} Harus di isi ya'
    //         ]
    //         ]
            
    //     ]
    //     );

    //     if (!$validate) {
    //         $msg = [
    //         'error' => [
    //         'periode_langgar_id' => $this->validate->getError('periode_langgar_id'),
    //         'user_created_id' => $this->validate->getError('user_created_id'),
    //         'siswa_kelas_id' => $this->validate->getError('siswa_kelas_id'),
    //         'tgl_kejadian' => $this->validate->getError('tgl_kejadian'),
    //         'pelanggaran_id' => $this->validate->getError('pelanggaran_id'),
    //         'jenis_pelanggaran' => $this->validate->getError('jenis_pelanggaran')
    //         ]
    //         ];
    //     }else{

    //         // tindak lanjut 
    //         $post = $this->request->getPost();
    //         if ($post['status_tindak_lanjut']=="selesai") {
    //             # code...
    //         }



    //         $data =[
    //             'periode_langgar_id'=> $this->request->getPost('periode_langgar_id'),
    //             'user_created_id'=> $this->request->getPost('user_created_id'),
    //             'siswa_kelas_id'=> $this->request->getPost('siswa_kelas_id'),
    //             'pelanggaran_id'=> $this->request->getPost('pelanggaran_id'),
    //             'bukti_pelanggaran'=> null,
    //             'status_tindak_lanjut'=> null,
    //             'keterangan'=> $this->request->getPost('keterangan'),
    //             'tgl_kejadian'=> $this->request->getPost('tgl_kejadian')
    //         ];
            
    //         $mPelanggaran = new PelanggaranSiswaModel;
    //         $mPelanggaran->save($data);
    //         $msg = ['sukses'=> 201];
    //     }
     
    //     echo json_encode($msg);
       
    //    }
    }

    

function Info() {
if ($this->request->isAJAX()) {
$id = $this->request->getVar('id');
$mPelanggaran = new PelanggaranSiswaModel;
$data = [
'd'=> $mPelanggaran->InfoPelanggaran($id)];
$view = ['view'=> view('Guru/Pelanggaran/Info', $data) ];
echo json_encode($view);
}
}

function PelanggaranTanggal() {
    $langgarM = new PelanggaranSiswaModel;
    if ($this->request->isAJAX()) {
       $post = $this->request->getPost();

       $langgar = $langgarM->ByTanggal($post['start'],$post['end']);
       $data = [
        'start'=> $post['start'],
        'end'=> $post['end'],
        'news'=> $langgar];


       $view = ['riwayat'=>view('Guru/Pelanggaran/by_tanggal', $data)];
       echo json_encode($view);
    }
    
}

}
