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
 function ListOfSekolah()
{
    return $builder = master_conn()
    ->table('sekolah')
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

function RombelByLevel($level_kelas_id)
{
   return $builder = master_conn()
   ->table('tm_kelas_rombel_walas')
   ->select('tm_kelas_rombel_walas.id,
   tm_kelas_rombel.rombel,
   m_guru.nm_guru
   ')
   ->join('tm_kelas_rombel','tm_kelas_rombel_walas.rombel_id=tm_kelas_rombel.id')
   ->join('m_guru','tm_kelas_rombel_walas.guru_id=m_guru.id')
   ->join('periode','tm_kelas_rombel_walas.periode_id=periode.id')
   ->where('periode.status_periode', 1)
   ->where('tm_kelas_rombel.level_kelas_id', $level_kelas_id)
   ->orderBy('tm_kelas_rombel.id', 'asc')
   ->get()
   ->getResultArray();

}

