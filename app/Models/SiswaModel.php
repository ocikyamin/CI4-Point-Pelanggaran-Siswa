<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table            = 'm_siswa';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];


public function SiswaByRombelId($rombel_id)
{
    return $this->db->table('m_siswa_kelas')
            ->select('
             m_siswa.id as siswa_id,
             m_siswa_kelas.id as siswa_rombel_id,
             m_siswa.nisn,
             m_siswa.nama_siswa,
             m_siswa.foto,
             tm_kelas_rombel.rombel,
             m_guru.nm_guru')
            ->join('tm_kelas_rombel','m_siswa_kelas.rombel_id=tm_kelas_rombel.id','left')
            ->join('m_guru','tm_kelas_rombel.guru_id=m_guru.id','left')
            ->join('m_siswa','m_siswa_kelas.siswa_id=m_siswa.id','right')

            ->where('tm_kelas_rombel.id', $rombel_id)
            // ->where('tm_kelas_rombel.periode_id', PeriodeAktif()->id)
            ->get()
            ->getResultArray();
}

public function SiswaNamaRombelId($rombel_id)
{
return $this->db->table('m_siswa_kelas')
->select('m_siswa_kelas.id,m_siswa.nisn,m_siswa.nama_siswa')
->join('m_siswa','m_siswa_kelas.siswa_id=m_siswa.id','right')

->join('tm_kelas_rombel','m_siswa_kelas.rombel_id=tm_kelas_rombel.id','left')
->join('m_guru','tm_kelas_rombel.guru_id=m_guru.id','left')


->where('m_siswa_kelas.rombel_id', $rombel_id)
->get()
->getResultArray();
}

    public function CariDataSiswa($filter = null,$keyword=null)
    {
        $periodeId = PeriodeAktif()->id ?? null;

if ($periodeId === null) {
    // Lakukan tindakan jika $periodeId kosong atau tidak ada, misalnya kembalikan hasil kosong atau berikan pesan error
    return []; // atau return 'Periode aktif tidak ditemukan';
}

if ($filter == 'nama') {
    // by nama
    return $this->db->table('m_siswa_kelas')
        ->select('
            m_siswa.id as siswa_id,
            m_siswa_kelas.id as siswa_rombel_id,
            m_siswa.nisn,
            m_siswa.nama_siswa,
            m_siswa.foto,
            tm_kelas_rombel.rombel,
            m_guru.nm_guru')
        ->join('tm_kelas_rombel', 'm_siswa_kelas.rombel_id=tm_kelas_rombel.id', 'left')
        ->join('m_guru', 'tm_kelas_rombel.guru_id=m_guru.id', 'left')
        ->join('m_siswa', 'm_siswa_kelas.siswa_id=m_siswa.id', 'right')
        ->like('m_siswa.nama_siswa', $keyword)
        ->where('tm_kelas_rombel.periode_id', $periodeId)
        ->get()
        ->getResultArray();
} else {
    return $this->db->table('m_siswa_kelas')
        ->select('
            m_siswa.id as siswa_id,
            m_siswa_kelas.id as siswa_rombel_id,
            m_siswa.nisn,
            m_siswa.nama_siswa,
            m_siswa.foto,
            tm_kelas_rombel.rombel,
            m_guru.nm_guru')
        ->join('tm_kelas_rombel', 'm_siswa_kelas.rombel_id=tm_kelas_rombel.id', 'left')
        ->join('m_guru', 'tm_kelas_rombel.guru_id=m_guru.id', 'left')
        ->join('m_siswa', 'm_siswa_kelas.siswa_id=m_siswa.id', 'right')
        ->where('m_siswa.nisn', $keyword)
        ->where('tm_kelas_rombel.periode_id', $periodeId)
        ->get()
        ->getResultArray();
}


      
    }


}
