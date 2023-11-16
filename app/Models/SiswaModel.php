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
->select('m_siswa.id,m_siswa.nisn,m_siswa.nama_siswa,m_siswa.jk,m_siswa_kelas.id as siswa_rombel_id,tm_kelas_rombel.rombel,m_guru.nm_guru')
->join('m_siswa','m_siswa_kelas.siswa_id=m_siswa.id','right')

->join('tm_kelas_rombel_walas','m_siswa_kelas.rombel_walas_id=tm_kelas_rombel_walas.id','left')
->join('m_guru','tm_kelas_rombel_walas.guru_id=m_guru.id','left')
->join('tm_kelas_rombel','tm_kelas_rombel_walas.rombel_id=tm_kelas_rombel.id','right')

->where('m_siswa_kelas.rombel_walas_id', $rombel_id)
->get()
->getResultArray();
}

public function SiswaNamaRombelId($rombel_id)
{
return $this->db->table('m_siswa_kelas')
->select('m_siswa_kelas.id,m_siswa.nisn,m_siswa.nama_siswa')
->join('m_siswa','m_siswa_kelas.siswa_id=m_siswa.id','right')

->join('tm_kelas_rombel_walas','m_siswa_kelas.rombel_walas_id=tm_kelas_rombel_walas.id','left')
->join('m_guru','tm_kelas_rombel_walas.guru_id=m_guru.id','left')
->join('tm_kelas_rombel','tm_kelas_rombel_walas.rombel_id=tm_kelas_rombel.id','right')

->where('m_siswa_kelas.rombel_walas_id', $rombel_id)
->get()
->getResultArray();
}

    public function CariDataSiswa($keyword)
    {
       return $this->db->table('m_siswa_kelas')
       ->select('m_siswa.id as siswa_id, m_siswa_kelas.id as siswa_rombel_id, m_siswa.nisn,m_siswa.nama_siswa,tm_kelas_rombel.rombel,m_guru.nm_guru')

       ->join('tm_kelas_rombel_walas','m_siswa_kelas.rombel_walas_id=tm_kelas_rombel_walas.id','left')
       ->join('m_guru','tm_kelas_rombel_walas.guru_id=m_guru.id','left')

       ->join('tm_kelas_rombel','tm_kelas_rombel_walas.rombel_id=tm_kelas_rombel.id','right')

       ->join('m_siswa','m_siswa_kelas.siswa_id=m_siswa.id','right')

       ->like('m_siswa.nisn', $keyword)
       ->orLike('m_siswa.nama_siswa', $keyword)
       ->orLike('tm_kelas_rombel.rombel', $keyword)

       ->get()
       ->getResultArray();
    }


}
