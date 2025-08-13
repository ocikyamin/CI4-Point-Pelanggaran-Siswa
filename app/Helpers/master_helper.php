<?php
function master_conn()
{
	return $db= \Config\Database::connect(); 
}

function SuperLogin()
{
    return $builder = session_con()
    ->table('users')
    ->where('id',session('super_sess'))
    ->get()
    ->getRow();


}

function PeriodeAktif()
{
   return $builder = master_conn()
    ->table('periode')
    ->where('status_periode',1)
    ->get()
    ->getRow();
}
function SemesterAktif()
{
   return $builder = master_conn()
    ->table('semester')
    ->where('status',1)
    ->get()
    ->getRow();
}
 function ListOfPeriode()
{
    return $builder = master_conn()
    ->table('periode')
    ->get()
    ->getResultArray();


}
 function ListOfSekolah()
{
    return $builder = master_conn()
    ->table('sekolah')
    ->get()
    ->getResultArray();


}
 function ListOfSemester()
{
    return $builder = master_conn()
    ->table('semester')
    ->get()
    ->getResultArray();


}
 function ListOfJabatan()
{
    return $builder = master_conn()
    ->table('m_jabatan')
    ->get()
    ->getResultArray();


}

// function RombelByLevel($id)
// {
//     return $builder = master_conn()
//     ->table('tm_kelas_rombel')
//     ->where('level_kelas_id', $id)
//     ->get()
//     ->getResultArray();


// }

function RombelByLevel($level_kelas_id, $periode)
{
   return $builder = master_conn()
   ->table('tm_kelas_rombel')
   ->select('tm_kelas_rombel.id,
   tm_kelas_rombel.rombel,
   m_guru.nm_guru
   ')

   ->join('m_guru','tm_kelas_rombel.guru_id=m_guru.id')
   ->join('periode','tm_kelas_rombel.periode_id=periode.id')
   ->where('tm_kelas_rombel.periode_id', $periode)
   ->where('tm_kelas_rombel.level_kelas_id', $level_kelas_id)
   ->orderBy('tm_kelas_rombel.id', 'asc')
   ->get()
   ->getResultArray();

}

 // Jumlah pelanggaran by sekolah 
  function JumlahSiswaMelanggarBySekolah($sekolah)
 {
    return $builder = master_conn()->table('pelanggaran_siswa')
    ->selectCount('pelanggaran_siswa.siswa_kelas_id')
    ->join('m_siswa_kelas','pelanggaran_siswa.siswa_kelas_id=m_siswa_kelas.id')
    ->join('tm_kelas_rombel','m_siswa_kelas.rombel_id=tm_kelas_rombel.id')
    ->join('tm_kelas_level','tm_kelas_rombel.level_kelas_id=tm_kelas_level.id')
    ->join('sekolah','tm_kelas_level.sekolah_id=sekolah.id')
    ->where('pelanggaran_siswa.periode_langgar_id', PeriodeAktif()->id)
    ->where('pelanggaran_siswa.semester_langgar_id', SemesterAktif()->id)
    ->where('sekolah.id', $sekolah)
    ->groupBy('pelanggaran_siswa.siswa_kelas_id')
    // ->get()
    ->countAllResults();
 }

