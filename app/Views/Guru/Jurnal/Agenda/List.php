<style>
    .mid tr th {
        vertical-align: middle; 
    }
    .mid tr td {
        vertical-align: middle; 
    }
</style>
<div class="table-responsive">
<table class="table table-bordered table-sm mb-3 mid" style="font-size:11px">
        <thead>
            <tr>
                <th rowspan="2" class="text-center">No.</th>
                <th rowspan="2">Hari/Tgl</th>
                <th rowspan="2"class="text-center">Waktu <div>(Jam Ke)</div></th>
                <th rowspan="2">Materi Pelajaran</th>
                <th colspan="2" class="text-center">Kehadiran</th>
                <th rowspan="2">Keterangan</th>
            </tr>
            <tr>
                <th class="text-center">Hadir</th>
                <th class="text-center">Tidak Hadir</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no=1;
            foreach ($list_agenda as $d) {?>
            <tr>
                <td class="text-center"><?=$no++?></td>
                <td><?=date('d/m/Y', strtotime($d['tgl_pertemuan']))?></td>
                <td width="10%" class="text-center">
                <!-- <div>(Jam ke- <?=$d['jam_ke']?>)</div> -->
                    <?=$d['waktu']?> </td>
                <td><?=$d['materi']?></td>
                <td class="text-center"><?=$d['jml_hadir']?></td>
                <td class="text-center"><?=$d['jml_tidak_hadir']?></td>
                <td><?=$d['keterangan']?></td>
            </tr>
            <tr>
                <td colspan="7">
                    <button onclick="KehadiranSiswa(<?=$d['id']?>)"  class="btn btn-success shadow-sm btn-sm p-1"><i class="ti ti-users"></i> Kehadiran</button>
                    <button onclick="EditPertemuan(<?=$d['id']?>)" class="btn btn-dark shadow-sm btn-sm p-1"><i class="ti ti-edit"></i> Ubah Agenda</button>
                    <button onclick="HapusPertemuan(<?=$d['id']?>)" class="btn btn-dark shadow-sm btn-sm p-1"><i class="ti ti-trash"></i></button>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


<div class="viewmodalagenda"></div>
<!-- <div id="presensi-from-agenda"></div> -->

<script>
      function EditPertemuan(id) {
        $.ajax({
            type: "post",
            url: "<?=base_url('teacher/jurnal/agenda/edit')?>",
            data: {id:id},
            dataType: "json",
            success: function (response) {
                $('.viewmodalagenda').html(response.edit).show()
                $('#modal-agenda').modal('show')
            }
        });
        
    }
    //   function KehadiranSiswa(id) {
    //     $.ajax({
    //         url: "<?=base_url('teacher/jurnal/presensi/list')?>",
    //         data: {
    //             id:id,
    //             rombel_id: <?=json_encode($rombel_id)?>,
    //         },
    //         dataType: "json",
    //         success: function (response) {
    //             $('#presensi-from-agenda').html(response.view)
    //             $('#modal-presensi').modal('show')
    //         }
    //     });
        
    // }
      function HapusPertemuan(id) {
        Swal.fire({
  title: "Apakah Yakin ?",
  text: "Tindakan Ini Akan Menghapus Data Agenda Pertemuan.",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Ya, Hapus Pertemuan"
}).then((result) => {
  if (result.isConfirmed) {
    $.ajax({
            type: "post",
            url: "<?=base_url('teacher/jurnal/agenda/delete')?>",
            data: {id:id},
            dataType: "json",
            success: function (response) {
                if (response.status=true) {
                Toastify({
                text: response.msg,
                afterHidden: function () {
                }    
                }).showToast();
                DaftarAgenda()
                RekapPresensi()

                }
        
            }
        });
  }
});

        
        
    }
</script>