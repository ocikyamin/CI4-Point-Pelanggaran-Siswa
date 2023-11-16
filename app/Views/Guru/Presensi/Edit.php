<style>
.form-check .ket[type="checkbox"] {
top: 0;
  left: 0;
  width: 25px;
  height: 25px;
  border: 2px solid #13DEB9;
  border-radius: 50%;
  cursor: pointer;
}

/* Styling the custom checkbox appearance for class "ket" */
.form-check .ket[type="checkbox"] + label {
  position: absolute;
  
  top: 0;
  left: 0;
  width: 20px;
  height: 20px;
  border-radius: 50%;
  border: 2px solid #13DEB9;
  cursor: pointer;
}

/* Styling the checked state for class "ket" */
.form-check .ket[type="checkbox"]:checked + label::before {
  content: "";
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 10px;
  height: 10px;
  background-color: #333;
  border-radius: 50%;
}

/* Adding hover animation for class "ket" */
.form-check .ket[type="checkbox"] + label::before {
  content: "";
  transition: all 0.3s ease;
}

.form-check .ket[type="checkbox"]:hover + label::before {
  background-color: #aaa;
}


</style>
<p>
<h5 class="card-title fw-semibold"><i class="ti ti-edit"></i> Ubah Daftar Hadir Siswa</h5>
</p>
<div class="table-responsive">
<form id="FormEditPresensi" method="post">
<input type="hidden" name="mapel_mengajar_id" value="<?=$pertemuan->mapel_mengajar_id?>">

<!-- info pertemuan  -->
<div class="row mb-3">
<div class="col-lg-8">
    <div class="form-group row mb-1">
    <label class="col-lg-3" for="">Tanggal</label>
    <div class="col-lg-7">
    <input type="date" name="tanggal" class="form-control form-control-sm shadow-sm" value="<?=$pertemuan->tanggal?>" disabled>
    </div>
    <div class="col-lg-2">
    <a href="#" onclick="HapusDaftarHadir(<?=$pertemuan->mapel_mengajar_id?>,<?=$pertemuan->pertemuan_ke?>)" class="btn btn-danger btn-sm"><i class="ti ti-trash-x"></i> Hapus</a>
    </div>
    </div>
    <div class="form-group row mb-1">
    <label class="col-lg-3" for="">Jam Pelajaran</label>
    <div class="col-lg-9">
    <input type="text" name="jam_ke" class="form-control form-control-sm shadow-sm" value="<?=$pertemuan->jam_ke?>" placeholder="07.15 - 08.15" disabled>
    </div>
    </div>
    <div class="form-group row mb-1">
    <label class="col-lg-3" for="">Pertemuan Ke-</label>
    <div class="col-lg-9">
    <input type="text" name="pertemuan_ke" class="form-control form-control-sm shadow-sm" value="<?=$pertemuan->pertemuan_ke?>" placeholder="(0)" disabled>
    </div>
   
    </div>
</div>
<!-- col-8  -->
<div class="col-lg-4">
<div class="form-check form-switch mb-3 mt-3">
<input class="form-check-input" type="checkbox" role="switch" id="hadir_all" style="cursor:pointer;">
<label class="form-check-label" for="hadir_all" style="cursor:pointer">Hadir Semua</label>
</div>

<div class="d-grid">
<button type="submit" id="btn-update-presensi" class="btn btn-warning"><i class="ti ti-edit"></i> SIMPAN PERUBAHAN</button>
</div>

</div>
<!-- col-4  -->
</div>


<!-- info pertemuan  -->
<table class="table table-sm table-bordered">
<thead>
<tr>
<th width="1" class="text-center">NO</th>
<th>NAMA LENGKAP SISWA</th>
<th class="text-center">KET</th>
<th width="1" class="bg-light text-center">H</th>
<th width="1" class="bg-light text-center">S</th>
<th width="1" class="bg-light text-center">I</th>
<th width="1" class="bg-light text-center">T</th>
<th width="1" class="bg-light text-center">A</th>
<th width="1" class="bg-light text-center">C</th>
</tr>
</thead>
<tbody>
<?php
$no = 1;
foreach ($siswa as $d) {
  $warna = "";
if ($d['kehadiran']=="H") {
$warna='white';
}elseif ($d['kehadiran']=="S") {
$warna='#27AE60;color:#ffff';
}elseif ($d['kehadiran']=="I") {
$warna='blue;color:#ffff';
}elseif ($d['kehadiran']=="T") {
$warna='yellow';
}elseif ($d['kehadiran']=="A") {
$warna='red;color:#ffff';
}elseif ($d['kehadiran']=="C") {
$warna='orange';
}
?>
<input type="hidden" name="presensi[]" value="<?=$d['id']?>">
<tr>
<td class="text-center"><?=$no++?></td>
<td><?=$d['nama_siswa']?></td>
<td class="text-center" style="background:<?=$warna?>"><?=$d['kehadiran']?></td>
<td>
<div class="form-check">
<input class="form-check-input ket shadow-sm hadir" type="checkbox" name="ket[]" id="h-<?=$d['siswa_kelas_id']?>" value="H" <?=$d['kehadiran']=='H' ? 'checked':null?>>
<label class="form-check-label" for="h-<?=$d['siswa_kelas_id']?>"></label>
</div>
</td>
<td>
<div class="form-check">
<input class="form-check-input ket no_hadir shadow-sm" type="checkbox" name="ket[]" id="s-<?=$d['siswa_kelas_id']?>" value="S" <?=$d['kehadiran']=='S' ? 'checked':null?>>
<label class="form-check-label" for="s-<?=$d['siswa_kelas_id']?>"></label>
</div>
</td>
<td>
<div class="form-check">
<input class="form-check-input ket no_hadir shadow-sm" type="checkbox" name="ket[]" id="i-<?=$d['siswa_kelas_id']?>" value="I" <?=$d['kehadiran']=='I' ? 'checked':null?>>
<label class="form-check-label" for="i-<?=$d['siswa_kelas_id']?>"></label>
</div>
</td>
<td>
<div class="form-check">
<input class="form-check-input ket no_hadir shadow-sm" type="checkbox" name="ket[]" id="t-<?=$d['siswa_kelas_id']?>" value="T" <?=$d['kehadiran']=='T' ? 'checked':null?>>
<label class="form-check-label" for="t-<?=$d['siswa_kelas_id']?>"></label>
</div>
</td>
<td>
<div class="form-check">
<input class="form-check-input ket no_hadir shadow-sm" type="checkbox" name="ket[]" id="a-<?=$d['siswa_kelas_id']?>" value="A" <?=$d['kehadiran']=='A' ? 'checked':null?>>
<label class="form-check-label" for="a-<?=$d['siswa_kelas_id']?>"></label>
</div>
</td>
<td>
<div class="form-check">
<input class="form-check-input ket no_hadir shadow-sm" type="checkbox" name="ket[]" id="c-<?=$d['siswa_kelas_id']?>" value="C" <?=$d['kehadiran']=='C' ? 'checked':null?>>
<label class="form-check-label" for="c-<?=$d['siswa_kelas_id']?>"></label>
</div>
</td>

</tr>
<?php } ?>
</tbody>
</table>
</form>
</div>
<!-- end daftar hadir  -->

</div>
<script>
  $(document).ready(function () {
    function toggleAllCheckboxes() {
    // Toggle the isAllChecked state
    isAllChecked = !isAllChecked;

    // Set the switch state based on the isAllChecked value
    $("#hadir_all").prop("checked", isAllChecked);

    // Set all checkboxes with class "hadir" based on the isAllChecked value
    $(".hadir").prop("checked", isAllChecked);
    $(".no_hadir").prop("checked", false);
    }

    // Set initial state of the switch to unchecked
    var isAllChecked = false;

    // Ketika switch "Hadir Semua" di-klik
    $("#hadir_all").on("click", function() {
    toggleAllCheckboxes();
    });
    // Hanya satu checkbox dalam setiap baris yang dapat dipilih
    $(".form-check-input").on("click", function() {
    var row = $(this).closest("tr");
    row.find(".form-check-input").not(this).prop("checked", false);
    });
  });
  $('#FormEditPresensi').submit(function (e) { 
    e.preventDefault();
    $.ajax({
      type: "post",
      url: "<?=base_url('teacher/presensi/update')?>",
      data: $(this).serialize(),
      dataType: "json",
      success: function (response) {
        if (response.sukses) {
          Swal.fire({
icon: 'success',
title: 'Selesai',
text: response.msg,
}).then((result) => {
    UpdatePresensi(<?=$pertemuan->mapel_mengajar_id?>,<?=$pertemuan->pertemuan_ke?>)
})

        }
        
      }
    });
    
  });


  function HapusDaftarHadir(id,pertemuan) {
    Swal.fire({
            title: 'Are you sure?',
            text: "Tindakan ini akan menghapus daftar hadir pada tanggal yang dipilh.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus Daftar Hadir!',
            cancelButtonText: 'Tidak'
            }).then((result) => {
            if (result.isConfirmed) {
            $.ajax({
            type: "post",
            url: "<?=base_url('teacher/presensi/delete')?>",
            data: {id:id,pertemuan:pertemuan},
            dataType: "json",
            success: function (response) {
            if (response.status) {
            Swal.fire(
            'Deleted!',
            response.msg,
            'success'
            ).then((result) => {
              TableRekap(<?=$pertemuan->mapel_mengajar_id?>)
            })
            }
            }
            });
            }
            })
  }
</script>
