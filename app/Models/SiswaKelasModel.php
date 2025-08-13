<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaKelasModel extends Model
{

    protected $table            = 'm_siswa_kelas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];



    public function SiswaKelasId($siswa_kelas_id)
    {
        return $this->db->table('m_siswa_kelas')
        ->select('
        m_siswa_kelas.id as siswa_kelas_id,
        m_siswa.nisn,
        m_siswa.nama_siswa,
        m_siswa.jk,
        m_siswa.hp_ortu,
        m_siswa.foto,
        tm_kelas_rombel.rombel
        ')
        ->join('tm_kelas_rombel','m_siswa_kelas.rombel_id=tm_kelas_rombel.id','right')



        ->join('m_siswa','m_siswa_kelas.siswa_id=m_siswa.id','right')

        ->where('m_siswa_kelas.id', $siswa_kelas_id)

        ->get()->getRow();
    }

    
    public function SiswaByRombel($rombel_id)
    {
        return $this->db->table('m_siswa_kelas')
        ->select('
        m_siswa_kelas.id,
        m_siswa.id as siswa_id,
        m_siswa.nisn,
        m_siswa.nama_siswa,
        m_siswa.jk,
        m_siswa.hp_ortu,
        tm_kelas_rombel.rombel
        ')
        ->join('tm_kelas_rombel','m_siswa_kelas.rombel_id=tm_kelas_rombel.id')

        ->join('m_siswa','m_siswa_kelas.siswa_id=m_siswa.id')

        ->where('m_siswa_kelas.rombel_id', $rombel_id)

        ->get()->getResultArray();
    }


}
