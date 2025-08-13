<?php
function session_con()
{
	return $db= \Config\Database::connect(); 
}

function ListOfPeriode()
{
    return $builder = session_con()
    ->table('periode')
    ->get()
    ->getResultArray();


}
function ListOfSemester()
{
    return $builder = session_con()
    ->table('semester')
    ->get()
    ->getResultArray();


}
function PeriodeAktif()
{
    return $builder = session_con()
    ->table('periode')
    ->where('status_periode',1)
    ->get()
    ->getRow();


}
function SemesterAktif()
{
   return $builder = session_con()
    ->table('semester')
    ->where('status',1)
    ->get()
    ->getRow();
}
function Jabatan()
{
   return $builder = session_con()
    ->table('m_jabatan')
    ->get()
    ->getResultArray();
}
 function TeacherLogin()
{
    return $builder = session_con()
    ->table('m_guru')
    ->where('id',session('teach_sess'))
    ->get()
    ->getRow();


}
function RombelByLevel($level_kelas_id)
{
   return $builder = session_con()
   ->table('tm_kelas_rombel')
   ->select('tm_kelas_rombel.id,
   tm_kelas_rombel.rombel,
   m_guru.nm_guru
   ')
//    ->join('tm_kelas_rombel','tm_kelas_rombel.rombel_id=tm_kelas_rombel.id')
   ->join('m_guru','tm_kelas_rombel.guru_id=m_guru.id')
   ->join('periode','tm_kelas_rombel.periode_id=periode.id')
   ->where('periode.status_periode', 1)
   ->where('tm_kelas_rombel.level_kelas_id', $level_kelas_id)
   ->orderBy('tm_kelas_rombel.id', 'asc')
   ->get()
   ->getResultArray();

}

