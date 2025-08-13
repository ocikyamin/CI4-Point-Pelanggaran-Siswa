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
   //  protected $useTimestamps = true;
   //  protected $dateFormat    = 'datetime';
   //  protected $createdField  = 'created_at';
   //  protected $updatedField  = 'updated_at';
   //  protected $deletedField  = 'deleted_at';


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
       pelanggaran_siswa.keterangan_final,
       pelanggaran_siswa.teruskan_ke,
       pelanggaran_siswa.status_tindak_lanjut,
       pelanggaran_siswa.lampiran,
       m_guru.nm_guru')
       ->join('pelanggaran_item','pelanggaran_siswa.pelanggaran_id=pelanggaran_item.id')
       ->join('m_guru','pelanggaran_siswa.user_created_id=m_guru.id')
       ->where('pelanggaran_siswa.siswa_kelas_id', $siswa_kelas_id)
       ->get()
       ->getResultArray();
    }


   //  Pelanggran Berdasarkan Kelas 
    public function PelanggaranByKelasId($periode=null, $semester=null,$rombel=null)
    {

      if ($periode =="" && $semester=="" && $rombel !="") {
         return $this->db->table('pelanggaran_siswa')
       ->select('
       pelanggaran_siswa.id,
       pelanggaran_siswa.siswa_kelas_id,
       pelanggaran_siswa.tgl_kejadian,
       m_siswa.nisn,
       m_siswa.nama_siswa,
       pelanggaran_item.nama_pelanggaran,
       pelanggaran_item.poin,
       pelanggaran_jenis.jenis,
       pelanggaran_siswa.keterangan,
       pelanggaran_siswa.status_tindak_lanjut,
       pelanggaran_siswa.keterangan_final,
       pelanggaran_siswa.teruskan_ke,
       pelanggaran_siswa.lampiran,
       m_guru.nm_guru')
       ->join('m_siswa_kelas','pelanggaran_siswa.siswa_kelas_id=m_siswa_kelas.id')
       ->join('m_siswa','m_siswa_kelas.siswa_id=m_siswa.id')
       ->join('pelanggaran_item','pelanggaran_siswa.pelanggaran_id=pelanggaran_item.id')
       ->join('pelanggaran_jenis','pelanggaran_item.jenis_id=pelanggaran_jenis.id')
       ->join('m_guru','pelanggaran_siswa.user_created_id=m_guru.id')
       ->where('m_siswa_kelas.rombel_id', $rombel)
      //  ->orderBy('pelanggaran_siswa.siswa_kelas_id', 'asc')
       ->orderBy('pelanggaran_siswa.tgl_kejadian', 'asc')
       ->get()
       ->getResultArray();
      }
       return $this->db->table('pelanggaran_siswa')
       ->select('
       pelanggaran_siswa.id,
       pelanggaran_siswa.siswa_kelas_id,
       pelanggaran_siswa.tgl_kejadian,
       m_siswa.nisn,
       m_siswa.nama_siswa,
       pelanggaran_item.nama_pelanggaran,
       pelanggaran_item.poin,
       pelanggaran_jenis.jenis,
       pelanggaran_siswa.keterangan,
       pelanggaran_siswa.status_tindak_lanjut,
       pelanggaran_siswa.keterangan_final,
       pelanggaran_siswa.teruskan_ke,
       pelanggaran_siswa.lampiran,
       m_guru.nm_guru')
       ->join('m_siswa_kelas','pelanggaran_siswa.siswa_kelas_id=m_siswa_kelas.id')
       ->join('m_siswa','m_siswa_kelas.siswa_id=m_siswa.id')
       ->join('pelanggaran_item','pelanggaran_siswa.pelanggaran_id=pelanggaran_item.id')
       ->join('pelanggaran_jenis','pelanggaran_item.jenis_id=pelanggaran_jenis.id')
       ->join('m_guru','pelanggaran_siswa.user_created_id=m_guru.id')
       ->where('pelanggaran_siswa.periode_langgar_id', $periode)
       ->where('pelanggaran_siswa.semester_langgar_id', $semester)
       ->where('m_siswa_kelas.rombel_id', $rombel)
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
       m_siswa.nisn,
       m_siswa.nama_siswa,
       pelanggaran_siswa.id,
       pelanggaran_siswa.tgl_kejadian,
       pelanggaran_siswa.status_tindak_lanjut,
       pelanggaran_siswa.tgl_penyelesaian,
       pelanggaran_siswa.keterangan,
       pelanggaran_siswa.lampiran,
       pelanggaran_jenis.jenis,
       pelanggaran_item.nama_pelanggaran,
       pelanggaran_item.poin
       ')
       ->join('m_siswa_kelas','pelanggaran_siswa.siswa_kelas_id=m_siswa_kelas.id')
       ->join('m_siswa','m_siswa_kelas.siswa_id=m_siswa.id')
       ->join('pelanggaran_item','pelanggaran_siswa.pelanggaran_id=pelanggaran_item.id')
       ->join('pelanggaran_jenis','pelanggaran_item.jenis_id=pelanggaran_jenis.id')
       ->join('m_guru','pelanggaran_siswa.user_created_id=m_guru.id')
       ->where('pelanggaran_siswa.user_created_id', $user_created_id)
       ->get()
       ->getResultArray();
    }


   //  Jumlah Pelanggran perkelas 
   public function JumlahSiswaMelanggarByKelasID($periode=null, $semester=null,$rombel=null)
   {
      return $this->db->table('pelanggaran_siswa')
      ->selectCount('pelanggaran_siswa.siswa_kelas_id')
      ->join('m_siswa_kelas','pelanggaran_siswa.siswa_kelas_id=m_siswa_kelas.id')
      ->where('pelanggaran_siswa.periode_langgar_id', $periode)
      ->where('pelanggaran_siswa.semester_langgar_id', $semester)
      ->where('m_siswa_kelas.rombel_id', $rombel)
      ->groupBy('pelanggaran_siswa.siswa_kelas_id')
      // ->get()
      ->countAllResults();
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
      pelanggaran_item.poin,
      pelanggaran_jenis.jenis,
      pelanggaran_siswa.status_tindak_lanjut,
      pelanggaran_siswa.teruskan_ke,
      pelanggaran_siswa.keterangan,
      pelanggaran_siswa.keterangan_final,
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
   public function InfoPelanggaran($id)
   {
      return $this->db->table('pelanggaran_siswa')
      ->select('
      pelanggaran_siswa.id,
      m_guru.nm_guru,
      m_siswa.nisn,
      m_siswa.nama_siswa,
      pelanggaran_siswa.tgl_kejadian,
      pelanggaran_siswa.tgl_penyelesaian,
      pelanggaran_siswa.lampiran,
      pelanggaran_item.nama_pelanggaran,
      pelanggaran_item.poin,
      pelanggaran_jenis.jenis,
      pelanggaran_siswa.keterangan,
      pelanggaran_siswa.status_tindak_lanjut,
      ')
      ->join('m_siswa_kelas','pelanggaran_siswa.siswa_kelas_id=m_siswa_kelas.id')
      ->join('m_siswa','m_siswa_kelas.siswa_id=m_siswa.id')
      ->join('pelanggaran_item','pelanggaran_siswa.pelanggaran_id=pelanggaran_item.id')
      ->join('pelanggaran_jenis','pelanggaran_item.jenis_id=pelanggaran_jenis.id')
      ->join('m_guru','pelanggaran_siswa.user_created_id=m_guru.id')
      ->where('pelanggaran_siswa.id', $id)
      ->get()
      ->getRow();
   }
   
   // Pelanggran by tanggal 
   public function ByTanggal($start=null,$end=null)
   {
      return $this->db->table('pelanggaran_siswa')
      ->select('
      pelanggaran_siswa.id,
      pelanggaran_siswa.siswa_kelas_id,
      pelanggaran_siswa.tgl_kejadian,
      m_siswa.nisn,
      m_siswa.nama_siswa,
      pelanggaran_item.nama_pelanggaran,
      pelanggaran_item.poin,
      pelanggaran_jenis.jenis,
      pelanggaran_siswa.keterangan,
      pelanggaran_siswa.status_tindak_lanjut,
      pelanggaran_siswa.keterangan_final,
      pelanggaran_siswa.teruskan_ke,
      pelanggaran_siswa.lampiran,
      m_guru.nm_guru')
      ->join('m_siswa_kelas','pelanggaran_siswa.siswa_kelas_id=m_siswa_kelas.id')
      ->join('m_siswa','m_siswa_kelas.siswa_id=m_siswa.id')
      ->join('pelanggaran_item','pelanggaran_siswa.pelanggaran_id=pelanggaran_item.id')
      ->join('pelanggaran_jenis','pelanggaran_item.jenis_id=pelanggaran_jenis.id')
      ->join('m_guru','pelanggaran_siswa.user_created_id=m_guru.id')
      ->where('pelanggaran_siswa.periode_langgar_id', PeriodeAktif()->id)
      // ->where('pelanggaran_siswa.semester_langgar_id', $semester)
      // ->where('m_siswa_kelas.rombel_id', $rombel)
      ->where('pelanggaran_siswa.tgl_kejadian >=', $start)
      ->where('pelanggaran_siswa.tgl_kejadian <=', $end)
     //  ->orderBy('pelanggaran_siswa.siswa_kelas_id', 'asc')
      ->orderBy('pelanggaran_siswa.tgl_kejadian', 'asc')
      ->get()
      ->getResultArray();
   }

   public function NotifList($id)
   {
      return $this->db->table('pelanggaran_siswa')
      ->select('
      pelanggaran_siswa.id,
      m_guru.nm_guru,
      m_siswa.nisn,
      m_siswa.nama_siswa,
      pelanggaran_siswa.tgl_kejadian,
      pelanggaran_siswa.tgl_penyelesaian,
      pelanggaran_siswa.lampiran,
      pelanggaran_item.nama_pelanggaran,
      pelanggaran_item.poin,
      pelanggaran_jenis.jenis,
      pelanggaran_siswa.keterangan,
      pelanggaran_siswa.status_tindak_lanjut,
      ')
      ->join('m_siswa_kelas','pelanggaran_siswa.siswa_kelas_id=m_siswa_kelas.id')
      ->join('m_siswa','m_siswa_kelas.siswa_id=m_siswa.id')
      ->join('pelanggaran_item','pelanggaran_siswa.pelanggaran_id=pelanggaran_item.id')
      ->join('pelanggaran_jenis','pelanggaran_item.jenis_id=pelanggaran_jenis.id')
      ->join('m_guru','pelanggaran_siswa.user_created_id=m_guru.id')
      ->where('pelanggaran_siswa.teruskan_ke', $id)
      ->get()
      ->getResultArray();
   }


}
