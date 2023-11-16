<?php

namespace App\Models;

use CodeIgniter\Model;

class PelanggaranSiswaModel extends Model
{
    protected $table            = 'pelanggaran_siswa';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


   //  Pelanggran siswa by id 
    public function PelanggaranBySiswaKelasId($siswa_kelas_id)
    {
       return $this->db->table('pelanggaran_siswa')
       ->select('
       pelanggaran_siswa.id,
       pelanggaran_siswa.tgl_kejadian,
       pelanggaran_item.nama_pelanggaran,
       pelanggaran_item.poin,
       pelanggaran_siswa.keterangan,
       pelanggaran_siswa.status_tindak_lanjut,
       pelanggaran_siswa.bukti_pelanggaran,
       m_guru.nm_guru')
       ->join('pelanggaran_item','pelanggaran_siswa.pelanggaran_id=pelanggaran_item.id')
       ->join('m_guru','pelanggaran_siswa.user_created_id=m_guru.id')
       ->join('periode','pelanggaran_siswa.periode_langgar_id=periode.id')
       ->where('pelanggaran_siswa.siswa_kelas_id', $siswa_kelas_id)
       ->where('periode.status_periode', 1)
       ->get()
       ->getResultArray();
    }


   //  Pelanggran Berdasarkan Kelas 
    public function PelanggaranByKelasId($rombel_walas_id)
    {
       return $this->db->table('pelanggaran_siswa')
       ->select('
       pelanggaran_siswa.id,
       pelanggaran_siswa.tgl_kejadian,
       m_siswa.nisn,
       m_siswa.nama_siswa,
       pelanggaran_item.nama_pelanggaran,
       pelanggaran_item.poin,
       pelanggaran_jenis.jenis,
       pelanggaran_siswa.keterangan,
       pelanggaran_siswa.status_tindak_lanjut,
       pelanggaran_siswa.bukti_pelanggaran,
       m_guru.nm_guru')
       ->join('m_siswa_kelas','pelanggaran_siswa.siswa_kelas_id=m_siswa_kelas.id')
       ->join('m_siswa','m_siswa_kelas.siswa_id=m_siswa.id')
       ->join('pelanggaran_item','pelanggaran_siswa.pelanggaran_id=pelanggaran_item.id')
       ->join('pelanggaran_jenis','pelanggaran_item.jenis_id=pelanggaran_jenis.id')
       ->join('m_guru','pelanggaran_siswa.user_created_id=m_guru.id')
       ->where('m_siswa_kelas.rombel_walas_id', $rombel_walas_id)
      //  ->orderBy('pelanggaran_siswa.siswa_kelas_id', 'asc')
       ->orderBy('pelanggaran_siswa.tgl_kejadian', 'asc')
       ->get()
       ->getResultArray();
    }


   //  Riwayat Entry data oleh guru 
    public function MyHistoryInput($user_created_id)
    {
       return $this->db->table('pelanggaran_siswa')
       ->select('
       m_siswa.nisn,m_siswa.nama_siswa,
       pelanggaran_siswa.id,
       pelanggaran_siswa.tgl_kejadian,
       pelanggaran_item.nama_pelanggaran,
       pelanggaran_item.poin')
       ->join('m_siswa_kelas','pelanggaran_siswa.siswa_kelas_id=m_siswa_kelas.id')
       ->join('m_siswa','m_siswa_kelas.siswa_id=m_siswa.id')
       ->join('pelanggaran_item','pelanggaran_siswa.pelanggaran_id=pelanggaran_item.id')
       ->join('m_guru','pelanggaran_siswa.user_created_id=m_guru.id')
       ->where('pelanggaran_siswa.user_created_id', $user_created_id)
       ->get()
       ->getResultArray();
    }


   //  Jumlah Pelanggran perkelas 

   public function JumlahSiswaMelanggarByKelasID($rombel_walas_id = null)
{
    if ($rombel_walas_id === null) {
        return 0;
    }
    
    return $this->db->table('pelanggaran_siswa')
    ->select('COUNT(DISTINCT(pelanggaran_siswa.siswa_kelas_id)) as total') // Count distinct siswa_kelas_id
    ->join('m_siswa_kelas', 'pelanggaran_siswa.siswa_kelas_id = m_siswa_kelas.id')
    ->join('periode', 'pelanggaran_siswa.periode_langgar_id = periode.id')
    ->where('periode.status_periode', 1)
    ->where('m_siswa_kelas.rombel_walas_id', $rombel_walas_id)
    ->get()
    ->getRow()
    ->total;
}


   // Pelanggaran Terbaru 
   public function NewsPelanggaran()
   {
      return $this->db->table('pelanggaran_siswa')
      ->select('
      pelanggaran_siswa.id,
      m_guru.nm_guru,
      m_siswa.nisn,
      m_siswa.nama_siswa,
      pelanggaran_siswa.tgl_kejadian,
      pelanggaran_item.nama_pelanggaran,
      pelanggaran_item.poin,
      pelanggaran_jenis.jenis,
      pelanggaran_siswa.keterangan,
      pelanggaran_siswa.status_tindak_lanjut,
      pelanggaran_siswa.bukti_pelanggaran
      ')
      ->join('m_siswa_kelas','pelanggaran_siswa.siswa_kelas_id=m_siswa_kelas.id')
      ->join('m_siswa','m_siswa_kelas.siswa_id=m_siswa.id')
      ->join('pelanggaran_item','pelanggaran_siswa.pelanggaran_id=pelanggaran_item.id')
      ->join('pelanggaran_jenis','pelanggaran_item.jenis_id=pelanggaran_jenis.id')
      ->join('m_guru','pelanggaran_siswa.user_created_id=m_guru.id')
      // ->groupBy('pelanggaran_siswa.siswa_kelas_id')
      ->limit(10)
    
      ->get()
      ->getResultArray();
   }
   
   // Pelanggran by tanggal 
   public function ByTanggal($tanggal)
   {
      return $this->db->table('pelanggaran_siswa')
      ->select('
      pelanggaran_siswa.id,
      m_guru.nm_guru,
      m_siswa.nisn,
      m_siswa.nama_siswa,
      pelanggaran_siswa.tgl_kejadian,
      pelanggaran_item.nama_pelanggaran,
      pelanggaran_item.poin,
      pelanggaran_jenis.jenis,
      pelanggaran_siswa.keterangan,
      pelanggaran_siswa.status_tindak_lanjut,
      pelanggaran_siswa.bukti_pelanggaran
      ')
      ->join('m_siswa_kelas','pelanggaran_siswa.siswa_kelas_id=m_siswa_kelas.id')
      ->join('m_siswa','m_siswa_kelas.siswa_id=m_siswa.id')
      ->join('pelanggaran_item','pelanggaran_siswa.pelanggaran_id=pelanggaran_item.id')
      ->join('pelanggaran_jenis','pelanggaran_item.jenis_id=pelanggaran_jenis.id')
      ->join('m_guru','pelanggaran_siswa.user_created_id=m_guru.id')
      ->where('pelanggaran_siswa.tgl_kejadian', $tanggal)
      ->get()
      ->getResultArray();
   }


}
