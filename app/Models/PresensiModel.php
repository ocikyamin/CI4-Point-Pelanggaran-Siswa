<?php

namespace App\Models;

use CodeIgniter\Model;

class PresensiModel extends Model
{
    protected $table            = 'kelas_presensi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];

    // Dates
    // protected $useTimestamps = false;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';


    public function JumlahPertemuan($mapel_megajar_id)
    {
        return $this->db->table('kelas_presensi');
    }
    // Cek jika tanggal, pertemuan telah di isi 
    public function Cek($tanggal,$mapel_mengajar_id,$pertemuan_ke)
    {
        return $this->db->table('kelas_presensi')
        ->where('tanggal', $tanggal)
        ->where('mapel_mengajar_id', $mapel_mengajar_id)
        ->where('pertemuan_ke', $pertemuan_ke)
        ->get()
        ->getNumRows();
        // ->getNumRows();
    }



    public function checkData($data)
    {
        // Validasi untuk Kondisi 1
        $existingData1 = $this->where('tanggal', $data['tanggal'])
            ->where('mapel_mengajar_id', $data['mapel_mengajar_id'])
            ->first();
        if (!empty($existingData1)) {
            return "Daftar Hadir Untuk Tanggal ".date('d/M/Y', strtotime($data['tanggal']))."  sudah ada.";
        }

        // Validasi untuk Kondisi 2
        $existingData2 = $this->where('tanggal', $data['tanggal'])
            ->where('mapel_mengajar_id', $data['mapel_mengajar_id'])
            ->where('pertemuan_ke', $data['pertemuan_ke'])
            ->first();
        if (!empty($existingData2)) {
            // return "Kondisi 2: Tanggal dan pertemuan_ke dengan mapel_mengajar_id sudah ada.";
            return "Daftar Hadir Untuk Tanggal ".date('d/M/Y', strtotime($data['tanggal']))." dan Pertemuan Ke- ".$data['pertemuan_ke']."  sudah ada.";
        }

        // Validasi untuk Kondisi 3
        $existingData3 = $this->where('mapel_mengajar_id', $data['mapel_mengajar_id'])
            ->where('pertemuan_ke', $data['pertemuan_ke'])
            ->first();
        if (!empty($existingData3)) {
            // return "Kondisi 3: Pertemuan_ke dengan mapel_mengajar_id sudah ada.";
            return "Daftar Hadir Untuk Pertemuan Ke- ".$data['pertemuan_ke']."  sudah ada.";
        }

        // Validasi untuk Kondisi 4
        $existingData4 = $this->where('tanggal', $data['tanggal'])
            ->where('mapel_mengajar_id', $data['mapel_mengajar_id'])
            ->where('pertemuan_ke', $data['pertemuan_ke'])
            ->first();
        if (!empty($existingData4)) {
            // return "Kondisi 4: Tanggal, mapel_mengajar_id, atau pertemuan_ke sudah ada.";
            return "Daftar Hadir Untuk Tanggal ".date('d/M/Y', strtotime($data['tanggal']))." dan Pertemuan Ke- ".$data['pertemuan_ke']."  sudah ada.";
        }

        return null;
    }


    public function GetSiswaPresensiPertemuan($mapel_mengajar_id,$pertemuan_ke)
    {
        return $this->db->table('kelas_presensi')
        ->select('
        kelas_presensi.id,
        kelas_presensi.siswa_kelas_id,
        m_siswa.nama_siswa,
        kelas_presensi.kehadiran
        ')
        ->join('m_siswa_kelas','kelas_presensi.siswa_kelas_id=m_siswa_kelas.id')
        ->join('m_siswa','m_siswa_kelas.siswa_id=m_siswa.id')
        ->where('kelas_presensi.mapel_mengajar_id', $mapel_mengajar_id)
        ->where('kelas_presensi.pertemuan_ke', $pertemuan_ke)
        ->get()
        ->getResultArray();
    }

}
