<?php

namespace App\Controllers\Guru;

use App\Controllers\BaseController;
use App\Models\MapelModel;
use App\Models\PeriodeModel;
use App\Models\SemesterModel;
use App\Models\KelasLevelModel;
use App\Models\KelasMengajarModel;
use App\Models\Jurnal\AgendaModel;
use App\Models\SiswaModel;
use App\Models\Jurnal\KehadiranModel;

class JurnalMengajar extends BaseController
{
    function __construct() {
    $this->mapelM = new MapelModel();
    $this->periodeM = new PeriodeModel();
    $this->semesterM = new SemesterModel();
    $this->levelM = new KelasLevelModel();
    $this->jadwalM = new KelasMengajarModel();
    $this->agendaM = new AgendaModel();
    $this->siswaM = new SiswaModel();
    $this->kehadiranM = new KehadiranModel();

        
    }
    protected $helpers = ['guru','presensi'];

    public function index()
    {
        $data = ['title'=> 'Jurnal Mengajar'
    ];
        return view('Guru/Jurnal/index', $data);
    }

public function JadwalList()
{
if ($this->request->isAJAX()) {
$data = ['jadwal'=> $this->jadwalM->ByGuru(TeacherLogin()->id)];

$view = ['table_kelas'=> view('Guru/Jurnal/Jadwal/List', $data) ];
echo json_encode($view);
}
}

public function JadwalAdd()
{
if ($this->request->isAJAX()) {
$post = $this->request->getVar();

$data = [
'mapel'=> $this->mapelM->findAll(),
'level'=> $this->levelM->findAll(),
'periode'=> $post['periode_id'],
'semester'=> $post['semester_id'],
];
$view = ['form_kelas'=> view('Guru/Jurnal/Jadwal/Add', $data)];
echo json_encode($view);
}
}
public function JadwalEdit()
{
if ($this->request->isAJAX()) {
    $post = $this->request->getVar();
    $data = [
    'mapel'=> $this->mapelM->findAll(),
    'level'=> $this->levelM->findAll(),
    'jadwal'=> $this->jadwalM->where('id', $post['id'])->first(),
    ];
    $view = ['form_kelas'=> view('Guru/Jurnal/Jadwal/Edit', $data)];
    echo json_encode($view);
}
}

public function JadwalSave()
{
if ($this->request->isAJAX()) {

    $this->validate= \Config\Services::validation();
    $validate = $this->validate(
    [
    'mapel_id' => [
    'label'  => 'Mata Pelajaran / Bidang Studi',
    'rules'  => 'required',
    'errors' => [
    'required' => '{field} Belum Terisi'
    ]
    ],
    'rombel_walas_id' => [
    'label'  => 'Kelas',
    'rules'  => 'required',
    'errors' => [
    'required' => '{field} Belum Terisi'
    ]
    ],
    'jam_ke' => [
    'label'  => 'Jam Pelajaran',
    'rules'  => 'required',
    'errors' => [
    'required' => '{field} Belum Terisi'
    ]
    ],
    'waktu' => [
    'label'  => 'Waktu Jam Pelajaran',
    'rules'  => 'required',
    'errors' => [
    'required' => '{field} Belum Terisi'
    ]
    ],
    ]
    );

    if (!$validate) {
        $response = [
        'error' => [
        'mapel_id' => $this->validate->getError('mapel_id'),
        'rombel_walas_id' => $this->validate->getError('rombel_walas_id'),
        'jam_ke' => $this->validate->getError('jam_ke'),
        'waktu' => $this->validate->getError('waktu'),
        ]
        ];
    }else{
        $post = $this->request->getVar();
        $data = [
            'id'=> isset($post['id']) ? $post['id'] :null,
            'guru_id'=> $post['guru_id'],
            'periode_id'=> $post['periode_id'],
            'semester_id'=> $post['semester_id'],
            'mapel_id'=> $post['mapel_id'],
            'rombel_walas_id'=> $post['rombel_walas_id'],
            'jam_ke'=> $post['jam_ke'],
            'waktu'=> $post['waktu'],
            'deskripsi'=> $post['deskripsi']
            ];
            $this->jadwalM->save($data);
            $response = ['status'=> 201];
    }
echo json_encode($response);
}
}
public function JadwalDelete()
{
if ($this->request->isAJAX()) {
$id = $this->request->getPost('id');
$this->jadwalM->delete($id);
$response = ['status'=> 201,'msg'=> 'Data kelas telah dihapus secara permanen.'];
echo json_encode($response);
}
}

// Detail Junal
function Agenda($id) {

    $kelas = $this->jadwalM->InfoKelasMengajar($id);
    $data = [
    'title'=> 'Jurnal Mengajar',
    'kelas_mengajar_id'=> $id,
    'kelas'=> $kelas];
    return view('Guru/Jurnal/Agenda/index', $data); 
    
}

function AgendList() {
    if ($this->request->isAJAX()) {
        $id = $this->request->getVar();
        $data = [
            'rombel_id'=> $id['rombel_id'],
            'list_agenda'=> $this->agendaM->where('kelas_mengajar_id', $id['jadwal_id'])->findAll()
        ];
        $view = ['list'=> view('Guru/Jurnal/Agenda/List', $data) ];
        echo json_encode($view);
        }
}
function AgendaAdd() {
    if ($this->request->isAJAX()) {
        $id = $this->request->getVar();
        $data = ['jadwal'=> $this->jadwalM->where('id',$id)->first()];
        $view = ['add'=> view('Guru/Jurnal/Agenda/Add', $data) ];
        echo json_encode($view);
    }
}
function AgendaEdit() {
    if ($this->request->isAJAX()) {
        $id = $this->request->getVar();
        $data = ['jadwal'=> $this->agendaM->where('id',$id)->first()];
        $view = ['edit'=> view('Guru/Jurnal/Agenda/Edit', $data) ];
        echo json_encode($view);
    }
}
function AgendaSave() {
    if ($this->request->isAJAX()) {
        $post= $this->request->getVar();

        $data = [
            'id'=> isset($post['id']) ? $post['id']:null,
            'kelas_mengajar_id'=> $post['jadwal_id'],
            'pertemuan'=> $post['pertemuan'],
            'tgl_pertemuan'=> $post['tgl_pertemuan'],
            'jam_ke'=> $post['jam_ke'],
            'waktu'=> $post['waktu'],
            'materi'=> $post['materi'],
            'keterangan'=> $post['keterangan'],
         
        ];
        $this->agendaM->save($data);
        $response = ['status'=> true];

        echo json_encode($response);
        }
}
function AgendaDelete() {
    if ($this->request->isAJAX()) {
        $id = $this->request->getPost('id');
        $this->agendaM->delete($id);
        $response = ['status'=> 201,'msg'=> 'Data Agenda telah dihapus.'];
        echo json_encode($response);
        }
}

// Agenda Print
function AgendaPrint($rombel_id) {
$id = intval($rombel_id);
$data = [
'list_agenda'=> $this->agendaM
->where('kelas_mengajar_id', $id)->findAll()
];  
// d($data);
return view('Guru/Jurnal/Agenda/Print.php');
}

// Presensi
function PresensiList() {
    if ($this->request->isAJAX()) {
        $id = $this->request->getVar('id');
        $rombel_id = $this->request->getVar('rombel_id');
        $data = [
            'agenda_id'=> $id,
            'status_kehadiran' => $this->kehadiranM->where('kelas_jurnal_id', $id)->first(),
            'jadwal'=> $this->agendaM->where('id',$id)->first(),
            'siswa'=>$this->siswaM ->SiswaNamaRombelId($rombel_id)
        ];
        $view = ['view'=> view('Guru/Jurnal/Presensi/index', $data)];
        echo json_encode($view);
    }
}

            function PresensiSave()  {
            if ($this->request->isAJAX()) {
            $request = $this->request->getPost();
            $jurnal_id = $request['jurnal_id'];
            $siswa = $request['siswa'];
            $ket = isset($request['ket']) ? $request['ket'] : '';
            $tanggal = date('Y-m-d');

            // Siapkan data untuk diinsert secara batch
            $dataToInsert = [];
            // Looping untuk menyimpan data kehadiran setiap siswa berdasarkan ID siswa yang dipilih
            for ($i = 0; $i < count($siswa); $i++) {
            $id_siswa = $siswa[$i];
            $keterangan = isset($ket[$i]) ? $ket[$i] : ''; // Menangani ketika checkbox tidak dipilih

            // Tambahkan data ke array untuk diinsert secara batch
            $dataToInsert[] = [
            'kelas_jurnal_id' => $jurnal_id,
            'm_siswa_kelas_id' => $id_siswa,
            'kehadiran' => $keterangan,
            'created_at' =>date('Y-m-d H:i:s'),
            ];
            }

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
            'error' => ['pilihan'=> 'Keterangan Kehadiran belum terisi sepenuhnya']
            ];
            }else{
                $update_jml_kehadiran=[
                    'id'=> $request['jurnal_id'],
                    'jml_hadir'=> $request['jumlahHadir'],
                    'jml_tidak_hadir'=> $request['jumlahTidakHadir'],
                ];
                if ($request['status_kehadiran']=='insert') {
                    # code...
                    $this->kehadiranM->insertBatch($dataToInsert);
                    $this->agendaM->save($update_jml_kehadiran);
                    $response = [
                        'sukses' => 201,'msg' => 'Data Kehadiran untuk Tanggal '.date('d/M/Y', strtotime($tanggal)). ' Berhasil disimpan.'];
                }else{
                    foreach ($dataToInsert as $data) {
                        $this->kehadiranM->set([
                            'kehadiran' => $data['kehadiran']
                        
                        ])->where(['m_siswa_kelas_id'=> $data['m_siswa_kelas_id'],'kelas_jurnal_id'=> $jurnal_id])->update();
                    }
                    $this->agendaM->save($update_jml_kehadiran);
                    
                    // $this->kehadiranM->replace($dataToInsert);
                    $response = [
                        'sukses' => 201,'msg' => 'Data Kehadiran untuk Tanggal '.date('d/M/Y', strtotime($tanggal)). ' Berhasil diperbarui.'];
                }
         
            }
            echo json_encode($response);
            }
            }

            function PresensiRekap() {
                if ($this->request->isAJAX()) {
                    $id = $this->request->getVar();
                    $data = [
                        'rombel_id'=> $id['rombel_id'],
                        'jadwal_id'=> $id['jadwal_id'],
                        'pertemuan'=> $this->agendaM->select('id,pertemuan,tgl_pertemuan')->where('kelas_mengajar_id', $id['jadwal_id'])->findAll(),
                        'siswa'=>$this->siswaM ->SiswaNamaRombelId($id['rombel_id'])
                    ];
                    $view = ['rekap'=> view('Guru/Jurnal/Presensi/Rekap', $data) ];
                    echo json_encode($view);
                    }
            }

}
