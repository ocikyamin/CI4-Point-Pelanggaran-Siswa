<?php
function ConPresensi()
{
	return $db= \Config\Database::connect(); 
}

function StatusPertemuan($mapel_mengajar_id)
{
//   return $builder = ConPresensi()->query("SELECT tanggal,pertemuan_ke FROM kelas_presensi WHERE mapel_mengajar_id=1 GROUP BY tanggal, pertemuan_ke ORDER BY tanggal, pertemuan_ke ASC")
//   ->get()
//   ->getResultArray();
// Tampilkan pertemuan tanggal yang telah di isi group dg tanggal peretemuan 
$query = ConPresensi()->query("SELECT tanggal,pertemuan_ke FROM kelas_presensi WHERE mapel_mengajar_id=$mapel_mengajar_id GROUP BY tanggal, pertemuan_ke ORDER BY tanggal, pertemuan_ke ASC");
$result = $query->getResultArray();
return $result;
}

function GetPertemuanKe($mapel_mengajar_id,$pertemuan_ke)
{
    return $builder = ConPresensi()
    ->table('kelas_presensi')
    ->select('tanggal,mapel_mengajar_id,jam_ke,pertemuan_ke,kehadiran')
    ->where('mapel_mengajar_id',$mapel_mengajar_id)
    ->where('pertemuan_ke',$pertemuan_ke)
    ->get()
    ->getRow();
}
function Kehadiran($tanggal=null,$mapel_mengajar_id=null,$siswa_kelas_id=null,$pertemuan_ke=null)
{
   if ($tanggal==NULL || $mapel_mengajar_id==NULL || $siswa_kelas_id==NULL || $pertemuan_ke==NULL) {
    return NULL;
   }else{
    return $builder = ConPresensi()
    ->table('kelas_presensi')
    ->select('tanggal,pertemuan_ke,kehadiran')
    ->where('tanggal',$tanggal)
    ->where('mapel_mengajar_id',$mapel_mengajar_id)
    ->where('siswa_kelas_id',$siswa_kelas_id)
    ->where('pertemuan_ke',$pertemuan_ke)
    ->get()
    ->getRow();
   }
}

function StatusPresensiToday($mapel_mengajar_id)
{
    return $builder = ConPresensi()
    ->table('kelas_presensi')
    ->where('mapel_mengajar_id',$mapel_mengajar_id)
    ->orderBy('pertemuan_ke', 'DESC')
    ->limit(1)
    ->get()
    ->getRow();
}

function StatusPresensiSiswaToday($tanggal,$mapel_mengajar_id,$siswa_kelas_id,$pertemuan_ke)
{
    return $builder = ConPresensi()
    ->table('kelas_presensi')
    ->where('tanggal',$tanggal)
    ->where('mapel_mengajar_id',$mapel_mengajar_id)
    ->where('siswa_kelas_id',$siswa_kelas_id)
    ->where('pertemuan_ke',$pertemuan_ke)
    ->get()
    ->getRow();
}


function hitungKehadiran($mapel_mengajar_id,$siswa_kelas_id,$keterangan)
{
return $builder = ConPresensi()
    ->table('kelas_presensi')
    ->where([
        'mapel_mengajar_id' => $mapel_mengajar_id,
        'siswa_kelas_id' => $siswa_kelas_id,
        'kehadiran' => $keterangan
    ])->countAllResults();
}