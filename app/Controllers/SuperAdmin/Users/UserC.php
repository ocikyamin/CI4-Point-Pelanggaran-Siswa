<?php

namespace App\Controllers\SuperAdmin\Users;
use App\Libraries\Hash;
use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use App\Models\UserModel;
use App\Models\GuruModel;

class UserC extends BaseController
{
    protected $helpers = ['master'];
    public function index()
    {
        $data = ['title'=> 'Users',
    ];
        return view('SuperAdmin/Users/index', $data);
    }

    public function SuperUserList()
    {
        if ($this->request->isAJAX()) {
            $userM = new UserModel;
            $data = ['user'=> $userM->findAll()];
            $msg = ['user_table'=> view('SuperAdmin/Users/Super/table', $data)];
            echo json_encode($msg);
            
        }
    }

    public function GuruList()
    {
        if ($this->request->isAJAX()) {
            $guruM = new GuruModel;
            $data = ['guru'=> $guruM->select('
            m_guru.id,
            m_guru.nuptk,
            m_guru.nm_guru,
            sekolah.nm_sekolah,
            m_jabatan.jabatan,
            m_guru.is_active
            ')
            ->join('sekolah','m_guru.sekolah_id=sekolah.id')
            ->join('m_jabatan','m_guru.jabatan_id=m_jabatan.id')
            ->findAll()];
            $msg = ['guru_table'=> view('SuperAdmin/Users/Guru/table', $data)];
            echo json_encode($msg);
            
        }
    }
    public function SetStatusGuru()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $guruM = new GuruModel;
            $guru = $guruM->find($id);
            $is_active = $guru['is_active'];
            $data = [
                'id'=> $id,
                'is_active'=> $is_active==1 ? NULL:1
            ];
            $guruM->save($data);
            $msg = [
                'sukses'=>201,
                'pesan'=> $is_active==1 ? 'Akun di Non Aktifkan': 'Akun di Aktifkan'
            ];
            echo json_encode($msg);
            
        }
    }

    public function ResetPasswordGuru()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $guruM = new GuruModel;
            $guru = $guruM->find($id);
            $nuptk = $guru['nuptk'];
            $data = [
                'id'=> $id,
                'password'=> Hash::make($nuptk)
            ];
            $guruM->save($data);
            $msg = [
                'sukses'=>201,
                'pesan'=> 'Password telah diubah ke '.$nuptk
            ];
            echo json_encode($msg);
            
        }
    }

    // guru

    function AddGuru()  {
        if ($this->request->isAJAX()) {
            $view = ['view'=> view('SuperAdmin/Users/Guru/Add')];
            echo json_encode($view);
            
        }
    }
    function ImportGuru()  {
        if ($this->request->isAJAX()) {
            $view = ['view'=> view('SuperAdmin/Users/Guru/Import')];
            echo json_encode($view);
            
        }
    }
    function EditGuru()  {
        if ($this->request->isAJAX()) {
            $guruM = new GuruModel;
            $id = $this->request->getVar('id');
            $data = ['d'=> $guruM->find($id)];
            $view = ['view'=> view('SuperAdmin/Users/Guru/Edit', $data)];
            echo json_encode($view);
            
        }
    }
    function DeleteGuru()  {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $guruM = new GuruModel;
            $guruM->delete($id);
            $msg = ['status'=> true, 'pesan'=> 'Data Guru Berhasl dihapus'];

            echo json_encode($msg);
            
        }
    }
    function StoreGuru()  {
        if ($this->request->isAJAX()) {
            $post = $this->request->getPost();

            $nuptk = $post['nuptk'];
       
            if (isset($post['old_nuptk']) && $post['old_nuptk']==$nuptk) {
                $rule = 'required';
            }else{
                $rule = 'required|is_unique[m_guru.nuptk]|min_length[7]|max_length[17]';
            }

            $this->validate= \Config\Services::validation();
            $validate = $this->validate(
            [
            'nuptk' => [
            'label'  => 'NUPTK',
            'rules'  => $rule,
            'errors' => [
            'required' => '{field} Belum Terisi',
            'is_unique' => '{field} Telah Terdaftar',
            'min_length' => '{field} Minimal 7 Angka',
            'max_length' => '{field} Maksimal 16 Angka'
            ]
            ],
            'full_name' => [
            'label'  => 'Nama Lengkap',
            'rules'  => 'required',
            'errors' => [
            'required' => '{field} Belum Terisi'
            ]
            ],
            'jabatan_id' => [
            'label'  => 'Jabatan',
            'rules'  => 'required',
            'errors' => [
            'required' => '{field} Belum Terisi'
            ]
            ],
            'sekolah_id' => [
            'label'  => 'Sekolah',
            'rules'  => 'required',
            'errors' => [
            'required' => '{field} Belum Terisi'
            ]
            ],        
            ]
            );
    
            if (!$validate) {
                $msg = [
                'error' => [
                'nuptk' => $this->validate->getError('nuptk'),
                'full_name' => $this->validate->getError('full_name'),
                'jabatan_id' => $this->validate->getError('jabatan_id'),
                'sekolah_id' => $this->validate->getError('sekolah_id'),
   
                ]
                ];
            }else{
                // $id = $this->request->getPost('id');
                $data = [
                    'id'=> isset($post['id']) ? $post['id'] :null,
                    'sekolah_id'=> $post['sekolah_id'],
                    'nuptk'=> $post['nuptk'],
                    // 'password'=>isset($id) ? $id :null, ,
                    'nm_guru'=> $post['full_name'],
                    'jabatan_id'=> $post['jabatan_id'],
                ];

                if (isset($post['new_password'])) {
                    $data['password']= Hash::make($post['new_password']);
                }
                $guruModel = new GuruModel;
                $save= $guruModel->save($data);
                $msg = [
                   'status'=> 200,
                   'msg'=> 'Data Guru berhasil disimpan.' ];
            }
            echo json_encode($msg);
        }
    }
    // function UpdateGuru()  {
    //     if ($this->request->isAJAX()) {
    //         $nuptk = $this->request->getPost('nuptk');
    //         $old_nuptk = $this->request->getPost('old_nuptk');
    //         if ($old_nuptk==$nuptk) {
    //             $rule = 'required';
    //         }else{
    //             $rule = 'required|is_unique[m_guru.nuptk]|min_length[7]|max_length[17]';
    //         }
      
    //         $this->validate= \Config\Services::validation();
    //         $validate = $this->validate(
    //         [
    //         'nuptk' => [
    //         'label'  => 'NUPTK',
    //         'rules'  => $rule,
    //         'errors' => [
    //         'required' => '{field} Belum Terisi',
    //         'is_unique' => '{field} Telah Terdaftar',
    //         'min_length' => '{field} Minimal 7 Angka',
    //         'max_length' => '{field} Maksimal 16 Angka'
    //         ]
    //         ],
    //         'full_name' => [
    //         'label'  => 'Nama Lengkap',
    //         'rules'  => 'required',
    //         'errors' => [
    //         'required' => '{field} Belum Terisi'
    //         ]
    //         ],
    //         'user_type' => [
    //         'label'  => 'Jenis Akun',
    //         'rules'  => 'required',
    //         'errors' => [
    //         'required' => '{field} Belum Terisi'
    //         ]
    //         ],
      
   
        
    //         ]
    //         );
    
    //         if (!$validate) {
    //             $msg = [
    //             'error' => [
    //             'nuptk' => $this->validate->getError('nuptk'),
    //             'full_name' => $this->validate->getError('full_name'),
    //             'user_type' => $this->validate->getError('user_type'),
   
    //             ]
    //             ];
    //         }else{
    //             $data = [
    //                 'id'=> $this->request->getPost('id'),
    //                 'nuptk'=> $this->request->getPost('nuptk'),
    //                 'nm_guru'=> $this->request->getPost('full_name'),
    //                 'type'=> $this->request->getPost('user_type'),
    //             ];
    //             $guruModel = new GuruModel;
    //             $save= $guruModel->save($data);
    //             $msg = [
    //                'status'=> 200,
    //                'msg'=> 'Data Guru Berhasil Diperbarui' ];
    //         }
    //         echo json_encode($msg);
    //     }
    // }

    // store import guru 

    function StoreImportGuru()  {
        if ($this->request->isAJAX()) {
            $sekolah_id = $this->request->getPost('sekolah_id');
            $file = $this->request->getFile('files');
    
            if (!$sekolah_id) {
                return $this->response->setStatusCode(400)->setJSON(['message' => 'Sekolah/Madrasah harus dipilih.']);
            }
    
            if (!$file->isValid() || $file->hasMoved()) {
                return $this->response->setStatusCode(400)->setJSON(['message' => 'Terjadi kesalahan saat mengunggah file.']);
            }
    
            $extension = $file->getClientExtension();
            if (!in_array($extension, ['xls', 'xlsx'])) {
                return $this->response->setStatusCode(400)->setJSON(['message' => 'Tipe file tidak valid. Hanya file .xls dan .xlsx yang diizinkan.']);
            }
    
            $filePath = $file->getTempName();
    
            if ($extension === 'xls') {
                $reader = new Xls();
            } else {
                $reader = new Xlsx();
            }
    
            $spreadsheet = $reader->load($filePath);
            $data = $spreadsheet->getActiveSheet()->toArray();
    
            $guruModel = new GuruModel();
    
            foreach ($data as $key => $row) {
                if ($key <2) {
                    continue; // Lewati baris header
                }
    
                $nuptk = $row[1];
                $nm_guru = $row[2];
                $password = $row[3];
                $jabatan_id = $row[4];
    
                $guruData = [
                    'sekolah_id' => $sekolah_id,
                    'nuptk' => $nuptk,
                    'nm_guru' => $nm_guru,
                    'password' => Hash::make($password),
                    'jabatan_id' => $jabatan_id,
                    'is_active' => 1,
                ];
    
                // Periksa apakah data sudah ada
                $existingGuru = $guruModel->where('nuptk', $nuptk)->first();
    
                if ($existingGuru) {
                    // Update data yang sudah ada
                    $guruModel->update($existingGuru['id'], $guruData);
                } else {
                    // Insert data baru
                    $guruModel->insert($guruData);
                }
            }
    
            return $this->response->setStatusCode(200)->setJSON(['message' => 'Data berhasil diimpor']);
        }
    }
}
