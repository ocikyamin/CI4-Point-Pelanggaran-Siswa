<?php
function ConPresensi()
{
	return $db= \Config\Database::connect(); 
}


function hitungKehadiran($agenda_id,$siswa_kelas_id,$keterangan)
{
return $builder = ConPresensi()
    ->table('kelas_kehadiran')
    // ->selectCount('')
    ->join('kelas_jurnal','kelas_kehadiran.kelas_jurnal_id=kelas_jurnal.id')
    ->where([
        'kelas_jurnal.kelas_mengajar_id' => $agenda_id,
        'kelas_kehadiran.m_siswa_kelas_id' => $siswa_kelas_id,
        'kelas_kehadiran.kehadiran' => $keterangan
    ])->countAllResults();
}