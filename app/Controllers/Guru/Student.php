<?php
namespace App\Controllers\Guru;
use App\Controllers\BaseController;
use App\Libraries\Hash;
use App\Models\GuruModel;
use App\Models\SiswaModel;
use App\Models\SiswaKelasModel;
use App\Models\PelanggaranSiswaModel;

class Student extends BaseController
{
    protected $helpers = ['guru','pps'];
    public function index()
    {
        $guruModel = new GuruModel;
        $pelanggranM = new PelanggaranSiswaModel;
        $rombel_walas = $guruModel->RombelWalasAktif(TeacherLogin()->id);
    if (is_null($rombel_walas)) {
    //    echo "null";
    return redirect()->back();
    }else {
        $data = [
            'title'=> 'Student List',
            'rombel_aktif'=> $rombel_walas,
         'siswa_melanggar' => $pelanggranM->JumlahSiswaMelanggarByKelasID($rombel_walas['kelas_aktif_id'])
    ];
    return view('Guru/Student/index', $data);
    }
    }

    public function StudentByRombel()
    {
        if ($this->request->isAJAX()) {
            $rombel_id = $this->request->getVar('rombel_id');
            $mSiswa = new SiswaModel;
            $data = [
                'rombel_id'=> $rombel_id,
                'siswa'=> $mSiswa->SiswaByRombelId($rombel_id) ];
            $msg = ['view'=> view('Guru/Student/table_siswa_rombel', $data)];
            echo json_encode($msg);
        }
    }

    public function StudentAdd()
    {
        if ($this->request->isAJAX()) {
            $data = ['rombel_id'=> $this->request->getVar('rombel_id')];
            $msg = ['view'=> view('Guru/Student/Add', $data)];
            echo json_encode($msg);
        }
    }

    public function StudentSave()
    {
        if ($this->request->isAJAX()) {
            $this->validate= \Config\Services::validation();
         $validate = $this->validate(
         [
            
         'nisn' => [
         'label'  => 'NISN / No.BP',
         'rules'  => 'required|is_unique[m_siswa.nisn]|max_length[11]',
         'errors' => [
         'required' => '{field} Tidak Boleh Kosong',
         'is_unique' => '{field} Telah Terdaftar',
         'max_length' => '{field} Maksimal 10 Angka'
         ]
         ],
         'nama_siswa' => [
         'label'  => 'Nama Lengkap Siswa',
         'rules'  => 'required',
         'errors' => [
         'required' => '{field} Tidak Boleh Kosong'
         ]
         ],
         'jk' => [
         'label'  => 'Jenis Kelamin',
         'rules'  => 'required',
         'errors' => [
         'required' => '{field} Tidak Boleh Kosong'
         ]
         ],
         'rombel_id' => [
            'label'  => 'Rombel',
            'rules'  => 'required',
            'errors' => [
            'required' => '{field} Tidak Ditemukan.'
            ]
            ]
         ]
         );
 
         if (!$validate) {
             $msg = [
             'error' => [
             'nisn' => $this->validate->getError('nisn'),
             'nama_siswa' => $this->validate->getError('nama_siswa'),
             'jk' => $this->validate->getError('jk'),
             'rombel_id' => $this->validate->getError('rombel_id')
             ]
             ];
         }else{
            $mSiswa = new SiswaModel;
            $nisn= $this->request->getPost('nisn');
            $rombel_id = $this->request->getPost('rombel_id');
            $data = [
                'nisn'=> $nisn,
                'password'=> Hash::make($nisn),
                'nama_siswa'=> $this->request->getPost('nama_siswa'),
                'jk'=> $this->request->getPost('jk'),
                'nama_ortu'=> $this->request->getPost('nama_ortu'),
                'hp_ortu'=> $this->request->getPost('hp_ortu')
             ];

             $save = $mSiswa->save($data);
            //  Get Last id siswa 
            $siswaID = $mSiswa->getInsertID();
            $mSiswaKelas = new SiswaKelasModel;
            $data_kelas = [
                'rombel_walas_id'=> $rombel_id,
                'siswa_id'=> $siswaID 
            ];
            $save_siswa_kelas = $mSiswaKelas->save($data_kelas);
             $msg = ['sukses'=> 200,'msg'=> 'Data Siswa Berhasil Ditambahkan.'];



         }


         echo json_encode($msg);
        }
    }

    public function StudentEdit()
    {
        if ($this->request->isAJAX()) {
            $rombel_id = $this->request->getVar('rombel_id');
            $siswa_id = $this->request->getVar('siswa_id');
            $mSiswa = new SiswaModel;
            $data = [
                'rombel_id'=> $rombel_id,
                'siswa'=> $mSiswa->find($siswa_id)];
            $msg = ['view'=> view('Guru/Student/Edit', $data)];
            echo json_encode($msg);
        }
    }
    public function StudentUpdate()
    {
        if ($this->request->isAJAX()) {
            $nisn= $this->request->getPost('nisn');
            $old_nisn= $this->request->getPost('old_nisn');
            if ($old_nisn==$nisn) {
                $rule_nisn = 'required|max_length[11]';
            }else{
                $rule_nisn = 'required|is_unique[m_siswa.nisn]|max_length[11]'; 
            }


        $this->validate= \Config\Services::validation();
         $validate = $this->validate(
         [
         'nisn' => [
         'label'  => 'NISN / No.BP',
         'rules'  => $rule_nisn,
         'errors' => [
         'required' => '{field} Tidak Boleh Kosong',
         'is_unique' => '{field} Telah Terdaftar',
         'max_length' => '{field} Maksimal 10 Angka'
         ]
         ],
         'nama_siswa' => [
         'label'  => 'Nama Lengkap Siswa',
         'rules'  => 'required',
         'errors' => [
         'required' => '{field} Tidak Boleh Kosong'
         ]
         ],
         'jk' => [
         'label'  => 'Jenis Kelamin',
         'rules'  => 'required',
         'errors' => [
         'required' => '{field} Tidak Boleh Kosong'
         ]
         ]
         ]
         );
 
         if (!$validate) {
             $msg = [
             'error' => [
             'nisn' => $this->validate->getError('nisn'),
             'nama_siswa' => $this->validate->getError('nama_siswa'),
             'jk' => $this->validate->getError('jk')
             ]
             ];
         }else{
            $mSiswa = new SiswaModel;
            $rombel_id = $this->request->getPost('rombel_id');
            $data = [
                'id'=> $this->request->getPost('siswa_id'),
                'nisn'=> $nisn,
                'nama_siswa'=> $this->request->getPost('nama_siswa'),
                'jk'=> $this->request->getPost('jk'),
                'nama_ortu'=> $this->request->getPost('nama_ortu'),
                'hp_ortu'=> $this->request->getPost('hp_ortu')
             ];

             $save = $mSiswa->save($data);
             $msg = ['sukses'=> 200,'msg'=> 'Data Siswa Berhasil Diperbarui.'];



         }


         echo json_encode($msg);
        }
    }
}
