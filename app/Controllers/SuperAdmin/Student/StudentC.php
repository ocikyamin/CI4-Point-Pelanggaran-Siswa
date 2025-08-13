<?php

namespace App\Controllers\SuperAdmin\Student;


use App\Controllers\BaseController;
use App\Libraries\Hash;
use App\Models\SekolahModel;
use App\Models\KelasLevelModel;
use App\Models\KelasRombelModel;
use App\Models\SiswaModel;
use App\Models\SiswaKelasModel;
// use App\Models\PelanggaranSiswaModel;

class StudentC extends BaseController
{
    function __construct() {
        $this->sekolahM = new SekolahModel();
        $this->rombelM = new KelasRombelModel();
        $this->SiswaM = new SiswaModel();
        $this->siswaRombelM = new SiswaKelasModel();
        
    }
    protected $helpers = ['master','eskul'];
    public function index()
    {
        

        $data = [
            'title'=> 'Student',
            'sekolah'=> $this->sekolahM->findAll()

    ]; 
    return view('SuperAdmin/Student/index', $data);
    }

    
    public function ByRombel()
    {
        if ($this->request->isAJAX()) {
            $rombel = $this->request->getVar('rombel');

            $data = [
                'rombel'=> $this->rombelM->InfoRombel($rombel),
                'siswa'=> $this->siswaRombelM->SiswaByRombel($rombel)
            ];

            $msg = ['table_rombel_siswa'=> view('SuperAdmin/Student/student_by_rombel', $data)];
            echo json_encode($msg);
           
        }
    }
    
    public function MoveSiswa()
    {
        if ($this->request->isAJAX()) {
            $siswaIDs = $this->request->getPost('ids');
        $rombelID = $this->request->getPost('rombel_id');

        if (empty($siswaIDs) || !$rombelID) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal ! Data tidak lengkap.']);
        }

    

        $response = [];

        foreach ($siswaIDs as $siswaID) {
            // Cek apakah siswa sudah ada di rombel tersebut
            $existing = $this->siswaRombelM->where('siswa_id', $siswaID)
                                         ->where('rombel_id', $rombelID)
                                         ->first();

            if ($existing) {
                // Jika sudah ada, tambahkan informasi ke response
                $response[] = [
                    'id' => $siswaID,
                    'message' => 'Siswa dengan ID ' . $siswaID . ' sudah ada dalam rombel ini.',
                    'status' => 'duplicate'
                ];
            } else {
                // Jika belum ada, lakukan pemindahan
                $data = [
                    'siswa_id' => $siswaID,
                    'rombel_id' => $rombelID,
                    // Sesuaikan dengan kolom lain yang diperlukan
                ];

                // Insert data pemindahan siswa ke rombel
                $this->siswaRombelM->insert($data);

                // Tambahkan informasi ke response
                $response[] = [
                    'id' => $siswaID,
                    'message' => 'Siswa dengan ID ' . $siswaID . ' berhasil dipindahkan ke rombel.',
                    'status' => 'success'
                ];
            }
        }

        return $this->response->setJSON($response);
           
        }
    }

    function DeleteSiswa()  {
        if ($this->request->isAJAX()) {
            $ids = $this->request->getPost('ids');
            $rombel_id = $this->request->getPost('rombel_id');

            if ($ids) {
                // Hapus siswa berdasarkan id
                foreach ($ids as $id) {
                    $tm = $this->siswaRombelM->select('siswa_id')->where('id', $id)->first();
                    $this->SiswaM->where('id', $tm['siswa_id'])->where('rombel_awal_id', $rombel_id)->delete();
                    $this->siswaRombelM->delete($id);
                }
    
                // Response JSON jika berhasil
                return $this->response->setJSON(
                    [
                    'status' => 'success',
                     'message' => 'Data siswa berhasil dihapus.'
                    ]);
            } else {
                // Response JSON jika tidak ada id yang dikirim
                return $this->response->setJSON(['status' => 'error', 'message' => 'Tidak ada data siswa yang dihapus.']);
            }
        }
    }


    // Upload siswa 
    function UploadSiswa() {
        if ($this->request->isAJAX()) {
            $this->validate = \Config\Services::validation();
            $validate = $this->validate([
                'rombel_id' => [
                    'label'  => 'Kelas Rombel',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => '{field} Belum dipilih',
                    ]
                ],
                'file_excel' => [
                    'label'  => 'File Excel',
                    'rules'  => 'uploaded[file_excel]|ext_in[file_excel,xls,xlsx]',
                    'errors' => [
                        'uploaded' => '{field} Belum ada',
                        'ext_in' => '{field} Ekstensi file yang diizinkan (xls dan xlsx)',
                    ]
                ],
            ]);
        
            if (!$validate) {
                $response = [
                    'status' => false,
                    'rombel_id' => $this->validate->getError('rombel_id'),
                    'file_excel' => $this->validate->getError('file_excel'),
                ];
            } else {
                $rombel_id = $this->request->getPost('rombel_id');
                $file = $this->request->getFile('file_excel');
                $ext = $file->getClientExtension();
                
                // Load spreadsheet
                if ($ext == 'xls') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                }
                
                $spreadsheet = $reader->load($file);
                $worksheet = $spreadsheet->getActiveSheet()->toArray();
                
                // Prepare data to insert into SiswaM
                $data_siswaM = [];
        
                foreach ($worksheet as $key => $row) {
                    if ($key < 2) {
                        continue;  // Skip first 2 rows
                    }
        
                    $nisn = $row[1]; // assuming NISN is in the 2nd column
                    $existing_siswa = $this->SiswaM->where('nisn', $nisn)->first();
        
                    if (!$existing_siswa) {
                        // Siswa baru yang belum ada di SiswaM
                        $data_siswaM[] = [
                            'nisn' => $nisn,
                            'nama_siswa' => $row[2], // assuming nama_siswa is in the 3rd column
                            'jk' => $row[3], // assuming jk is in the 4th column
                            'nama_ortu' => $row[4], // assuming nama_ortu is in the 5th column
                            'hp_ortu' => $row[5], // assuming hp_ortu is in the 6th column
                            'password' => Hash::make($row[6]), // assuming password is in the 7th column
                            'rombel_awal_id' => $rombel_id,
                        ];
                    }
                }
        
                // Insert new data into SiswaM
                if (!empty($data_siswaM)) {
                    $this->SiswaM->insertBatch($data_siswaM);
                }
        
                // Prepare array to store siswaRombelM data
                $siswa_rombel_data = [];
        
                // Get IDs of newly inserted students from SiswaM
                foreach ($data_siswaM as $siswa) {
                    $siswa_data = $this->SiswaM->where('nisn', $siswa['nisn'])->first();
                    if ($siswa_data) {
                        $siswa_rombel_data[] = [
                            'siswa_id' => $siswa_data['id'],
                            'rombel_id' => $rombel_id,
                        ];
                    }
                }
        
                // Insert data into siswaRombelM
                if (!empty($siswa_rombel_data)) {
                    $this->siswaRombelM->insertBatch($siswa_rombel_data);
                }
        
                // Prepare response
                if (!empty($siswa_rombel_data)) {
                    $response = [
                        'status' => true,
                        'rombel_id' => $rombel_id,
                    ];
                } else {
                    $response = [
                        'status' => false,
                        'file_excel' => 'Gagal Import data',
                    ];
                }
            }
        
            echo json_encode($response);
        }
        
       
        
    }

    function Add() {
        if ($this->request->isAJAX()) {
            $post = $this->request->getVar();
            $data = ['rombel_id'=> $post['rombel_id']];

            $view = ['view'=> view('SuperAdmin/Student/Add', $data)];
            echo json_encode($view);
        }
        
    }
    function Edit() {
        if ($this->request->isAJAX()) {
            $post = $this->request->getVar();
            $data = [
                'rombel_id'=> $post['rombel_id'],
                's'=> $this->SiswaM->find($post['siswa_id'])];

            $view = ['view'=> view('SuperAdmin/Student/Edit', $data)];
            echo json_encode($view);
        }
        
    }
    public function StudentStore()
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
            // $mSiswa = new SiswaModel;
            $id= $this->request->getPost('id');
            $nisn= $this->request->getPost('nisn');
            $rombel_id = $this->request->getPost('rombel_id');
            $data = [
                'id'=> isset($id) ? $id :null,
                'nisn'=> $nisn,
                'password'=> Hash::make($nisn),
                'nama_siswa'=> $this->request->getPost('nama_siswa'),
                'jk'=> $this->request->getPost('jk'),
                'nama_ortu'=> $this->request->getPost('nama_ortu'),
                'hp_ortu'=> $this->request->getPost('hp_ortu'),
                'rombel_awal_id'=> $rombel_id,
             ];

             $save = $this->SiswaM->save($data);
             if ($id =="") {
                //  Get Last id siswa 
                $siswaID = $this->SiswaM->getInsertID();
                // $mSiswaKelas = new SiswaKelasModel;
                $data_kelas = [
                'rombel_id'=> $rombel_id,
                'siswa_id'=> $siswaID 
                ];
                $save_siswa_kelas = $this->siswaRombelM->save($data_kelas);
             }

             $msg = [
                'sukses'=> 200,
                'rombel'=> $rombel_id,
                'msg'=> 'Data Siswa Berhasil Ditambahkan.'];
         }
         echo json_encode($msg);
        }
    }

   
}
