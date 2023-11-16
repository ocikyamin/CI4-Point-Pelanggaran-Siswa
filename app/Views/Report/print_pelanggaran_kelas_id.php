<!DOCTYPE html>
<html>
<head>
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    
    .info {
      width: 100%;
      border-collapse: collapse;
    }
    .info td {
      /* padding: 10px; */
      border-bottom: 1px solid #ccc;
      text-align: left;
    }

    .list  {
      width: 100%;
      border-collapse: collapse;
      font-size:12px;
    }
    .list th{
        border: 1px solid #ccc;
        height:30px;
        background-color: #f9f9f9;
    }
    .list td {
      padding: 3px;
      border: 1px solid #ccc;
      /* border-top: 1px solid #ccc;
      border-bottom: 1px solid #ccc;
      border-left: 1px solid #ccc;
      border-right: 1px solid #ccc; */
      /* text-align: left; */
    }
    .text-center{
        text-align: center;
    }

    

    
  </style>
  <title><?=$title?></title>
</head>
<body>
<table class="info" style="text-transform: uppercase;font-size:12px">
<td>TP</td>
        <td>:</td>
        <td><?=$kelas->nm_periode?></td>
        </tr>
        <tr>
        <td>Sekolah</td>
        <td>:</td>
        <td><?=$kelas->nm_sekolah?> (<?=$kelas->kepsek?>) </td>
        </tr>
       
        <tr>
        <td>Kelas</td>
        <td>:</td>
        <td><?=$kelas->level_kelas?> (<?=$kelas->rombel?>)</td>
        </tr>
    
        <tr>
        <td>Wali Kelas</td>
        <td>:</td>
        <td><?=$kelas->nm_guru?></td>
        </tr>
        </table>

<p>
    Riwayat Pelanggran
</p>
<table class="list">
        <thead>
        <tr>
        <th class="text-center">No.</th>
        <th>Petugas</th>
        <th>Siswa</th>
        <th>Tgl. Kejadian</th>
        <th>Pelanggaran</th>
        <th>Keterangan</th>
        <th>Tindak Lanjut</th>
        <th class="text-center">Poin</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $i=1;
        $total_poin =0;
        foreach ($siswa_melanggar as $d) {?>
        <tr>
        <td class="text-center"><?=$i++?>.</td>
        <td><?=$d['nm_guru']?></td>
        <td><?=$d['nama_siswa']?></td>
        <td><?=date('d/m/Y', strtotime($d['tgl_kejadian']))?></td>
        <td><?=$d['nama_pelanggaran']?></td>
        <td><?=$d['keterangan']?></td>
        <td><?=$d['status_tindak_lanjut']?></td>
        <td class="text-center"><?=$d['poin']?></td>
        </tr>
        <?php } ?>

        </tbody>
        </table>
</body>
<script>
    window.print()
</script>
</html>

