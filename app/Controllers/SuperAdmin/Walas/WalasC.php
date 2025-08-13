<?php

namespace App\Controllers\SuperAdmin\Walas;

use App\Controllers\BaseController;
use App\Models\SekolahModel;
use App\Models\GuruModel;
use App\Models\KelasLevelModel;
use App\Models\SiswaModel;
use App\Models\KelasRombelModel;
use App\Models\PelanggaranSiswaModel;

class WalasC extends BaseController
{
function __construct() {
  $this->LevelM = new KelasLevelModel();
  $this->rombelM = new KelasRombelModel();
  
}

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

    function WalasPeriode() {
      if ($this->request->isAJAX()) {
       $post = $this->request->getPost();
       $data = [
        'sekolah'=> $post['sekolah'],
        'periode'=> $post['periode'],
        'level'=> $this->LevelM->where('sekolah_id', $post['sekolah'])->findAll()
      ];



       $view = ['walas'=> view('SuperAdmin/Walas/walas_periode', $data)];

       echo json_encode($view);
       
      }      
    }
    // add

    function AddWalas() {
      if ($this->request->isAJAX()) {
        $post = $this->request->getVar();
        $guruM = New GuruModel();

        $data = [
          'level'=> $post['level_id'],
          'periode'=> $post['periode_id'],
          'sekolah'=> $post['sekolah_id'],
          'guru'=> $guruM->select('id,nuptk,nm_guru')->findAll()
          ];

        $view = ['form_rombel_walas'=> view('SuperAdmin/Walas/Add', $data)];

        echo json_encode($view);

      }
      
    }

    function EditWalas() {
      if ($this->request->isAJAX()) {
        $id = $this->request->getVar('id');
        $sekolah = $this->request->getVar('sekolah');
        $guruM = New GuruModel();
        $data = [
          'sekolah'=>$sekolah, 
          'd'=> $this->rombelM->find($id),
          'guru'=> $guruM->select('id,nuptk,nm_guru')->findAll()
         ];

        $view = ['form_rombel_walas'=> view('SuperAdmin/Walas/Edit', $data)];

        echo json_encode($view);

      }
      
    }
    function StoreWalas() {
      if ($this->request->isAJAX()) {



        $post = $this->request->getVar();
      //  if ($post['rombel'] !="" || $post['guru_id'] !="") {
        
      //  }else{
      //   $response = [
      //     'status'=> false,
      //     'msg'=> 'Inputan Nama Rombel dan Walas Harus di isi'
      // ];
      //  }
       $this->validate= \Config\Services::validation();
          $validate = $this->validate(
          [
          'rombel' => [
          'label'  => 'Nama Rombel',
          'rules'  => 'required',
          'errors' => [
          'required' => '{field} Tidak Boleh Kosong'
          ]
          ],
          'guru_id' => [
          'label'  => 'Wali Kelas',
          'rules'  => 'required',
          'errors' => [
          'required' => '{field} Tidak Boleh Kosong'
          ]
          ]
          ]
          );

          if (!$validate) {
          // $msg = [
          // 'error' => [
          // 'rombel' => $this->validate->getError('user_email'),
          // 'guru_id' => $this->validate->getError('user_pass')
          // ]
          // ];

          $response = [
            'status'=> false,
            'rombel' => $this->validate->getError('rombel'),
            'guru_id' => $this->validate->getError('guru_id')

          ];
          }else{
            $where = [
              'periode_id'=> $post['periode_id'],
              'level_kelas_id'=> $post['level_id'],
              'rombel'=> $post['rombel'],
            ];
            $cek = $this->rombelM->where($where)->first();
            if ($cek) {
            $response = [
              'status'=> false,
              'rombel' =>'Data Rombel Sudah ada .'
  
            ];
            }else{
              $data = [
                'id'=> isset($post['id'])? $post['id']:null,
                'periode_id'=> $post['periode_id'],
                'level_kelas_id'=> $post['level_id'],
                'rombel'=> $post['rombel'],
                'guru_id'=> $post['guru_id']
              ];
      
              $this->rombelM->save($data);
                $response = [
                  'status'=> true,
                  'sekolah'=> $post['sekolah_id'],
                  'periode'=> $post['periode_id'],
              ];
      
            }
          }

     
        
       
        echo json_encode($response);

      }
      
    }
    function DeleteWalas() {
      if ($this->request->isAJAX()) {
        $post = $this->request->getVar();
      

        $this->rombelM->delete($post['id']);
          $response = [
            'status'=> true,
            'sekolah'=> $post['sekolah_id'],
            'periode'=> $post['periode_id'],
        ];

        echo json_encode($response);

      }
      
    }





    public function Detail($rombel_id)
    {
        $siswaRombelM = new SiswaModel;
        $infoKelasM = new KelasRombelModel;
        $pelanggranM = new PelanggaranSiswaModel;

        $data = [
            'title'=> 'Detail Kelas',
            'kelas'=> $infoKelasM->InfoRombelWalas($rombel_id),
            'siswa_melanggar'=> $pelanggranM->JumlahSiswaMelanggarByKelasID($rombel_id),
            'siswa'=> $siswaRombelM->SiswaByRombelId($rombel_id)];

       return view('SuperAdmin/Walas/student_by_rombel', $data);
    }
}
