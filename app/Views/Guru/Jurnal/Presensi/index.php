<style>

    .form-check .ket[type="checkbox"] {
            width: 16px;
            height: 16px;
            border: 2px solid #13DEB9;
            border-radius: 50%;
            appearance: none;
            -webkit-appearance: none;
            outline: none;
            cursor: pointer;
            position: relative;
            background-color: #fff;
            margin-top: 0; /* Ensures checkbox is vertically centered with label */
        }

        .form-check .ket[type="checkbox"]:checked::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 12px;
            height: 12px;
            background-color: #13DEB9;
            border-radius: 50%;
        }

        .form-check .ket[type="checkbox"]:hover::before {
            background-color: black;
        }
        /* .form-check .form-check-label {
            position: relative;
            padding-left: 5px; 
            font-size: 18px; 
            cursor: pointer;
        } */

        /* td {
            padding: 10px;
        } */

</style>
<div class="modal fade" id="modal-presensi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="judul-presensi" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-success shadow-sm">
        <h1 class="modal-title fs-5 text-white" id="judul-presensi"> <i class="ti ti-list-check"></i> Daftar Kehadiran Siswa</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

<form id="FormKehadiran" method="post">
      <div class="modal-body">
        <?php
        // var_dump($jadwal);

        ?>
        <div class="alert bg-light shadow-sm">
          <b><i class="ti ti-info-circle"></i> Materi Pelajaran </b>
<p>
<?=$jadwal['materi']?>
</p>
<hr>
<div id="summary">
        <div class="row mb-3">
          <div class="col-lg-3">
          <div class="form-group">
              <label for="tgl_pertemuan">Tanggal Pertemuan</label>
              <input id="tgl_pertemuan" class="form-control form-control-sm" type="text" value="<?=date('d/m/Y', strtotime($jadwal['tgl_pertemuan']))?>" disabled>
            </div>
          </div>
          <div class="col-lg-3">
          <div class="form-group">
              <label for="pertemuan">Pertemuan Ke-</label>
              <input id="pertemuan" class="form-control form-control-sm" type="text" value="<?=$jadwal['pertemuan']?>" disabled>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="form-group">
              <label for="jumlahHadir">Jumlah Hadir (H):</label>
              <input id="jumlahHadir" class="form-control form-control-sm" type="text" name="jumlahHadir">
            </div>
          </div>
          <div class="col-lg-3">
          <div class="form-group">
              <label for="jumlahTidakHadir">Jumlah Tidak Hadir:</label>
              <input id="jumlahTidakHadir" class="form-control form-control-sm" type="text" name="jumlahTidakHadir">
            </div>
          </div>
          </div>
        </div>
        </div>
        
        
<div class="table-responsive">

<input type="hidden" name="jurnal_id" value="<?=$agenda_id?>">
<input type="hidden" name="status_kehadiran" value="<?=isset($status_kehadiran)? 'update':'insert'?>">
<!-- Infor Pertemuan  -->
<table class="mid table table-sm table-bordered">
<thead>
<tr>
<th rowspan="2" class="text-center">NO</th>
<th rowspan="2" style="min-width:260px">NAMA LENGKAP SISWA</th>
<th colspan="6">
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" role="switch" id="hadir_all" style="cursor:pointer;">
  <label class="form-check-label" for="hadir_all" style="cursor:pointer"><i class="ti ti-checkbox"></i> Semua Hadir</label>
  </div>
</th>
</tr>
<tr>
 
  <th class="text-center" width="1">H</th>
  <th class="text-center" width="1">S</th>
  <th class="text-center" width="1">I</th>
  <th class="text-center" width="1">T</th>
  <th class="text-center" width="1">A</th>
  <th class="text-center" width="1">C</th>
</tr>
</thead>
<tbody>
<?php

use App\Models\Jurnal\KehadiranModel;
$hadirM = New KehadiranModel();
$no = 1;
foreach ($siswa as $d) {
  // $stt ="";
  if ($status_kehadiran) {
    $stt = $hadirM->select('kehadiran')
    ->where('kelas_jurnal_id', $status_kehadiran['kelas_jurnal_id'])
    ->where('m_siswa_kelas_id', $d['id'])
    ->first();
  }else{
    $stt = null;
  }



// var_dump($stt);

// $ket="";
if ($stt) {
  $ket = $stt['kehadiran'];
}else{
  $ket = null;
}



?>
<input type="hidden" name="siswa[]" value="<?=$d['id']?>">
<tr>
<td class="text-center"><?=$no++?></td>
<td>
<div class="mb-2"><b><i class="ti ti-user"></i> <?=$d['nama_siswa']?></b></div>
</td>
<td>
<div class="form-check form-check-inline m-0">
<input class="form-check-input ket shadow-sm hadir" type="checkbox" name="ket[]" id="h-<?=$d['id']?>" value="H"
<?=$ket=='H' ? 'checked':null?>
 >
<label class="form-check-label" for="h-<?=$d['id']?>"></label>
</div>
</td>
<td>
<div class="form-check form-check-inline m-0">
<input class="form-check-input ket no_hadir shadow-sm" type="checkbox" name="ket[]" id="s-<?=$d['id']?>" value="S"
<?=$ket=='S' ? 'checked':null?>
>
<label class="form-check-label" for="s-<?=$d['id']?>"></label>
</div>
</td>
<td>
<div class="form-check form-check-inline m-0">
<input class="form-check-input ket no_hadir shadow-sm" type="checkbox" name="ket[]" id="i-<?=$d['id']?>" value="I"
<?=$ket=='I' ? 'checked':null?>
>
<label class="form-check-label" for="i-<?=$d['id']?>"></label>
</div>

</td>
<td>
  
<div class="form-check form-check-inline m-0">
<input class="form-check-input ket no_hadir shadow-sm" type="checkbox" name="ket[]" id="t-<?=$d['id']?>" value="T"
<?=$ket=='T' ? 'checked':null?>
>
<label class="form-check-label" for="t-<?=$d['id']?>"></label>
</div>

</td>
<td>
<div class="form-check form-check-inline m-0">
<input class="form-check-input ket no_hadir shadow-sm" type="checkbox" name="ket[]" id="a-<?=$d['id']?>" value="A"
<?=$ket=='A' ? 'checked':null?>
>
<label class="form-check-label" for="a-<?=$d['id']?>"></label>
</div>

</td>
<td>
<div class="form-check form-check-inline m-0">
<input class="form-check-input ket no_hadir shadow-sm" type="checkbox" name="ket[]" id="c-<?=$d['id']?>" value="C"
<?=$ket=='C' ? 'checked':null?>
>
<label class="form-check-label" for="c-<?=$d['id']?>"></label>
</div>
</td>

</tr>
<?php } ?>
</tbody>
</table>
<input type="hidden" id="jml_siswa" value="<?=$no-1?>">

</div>
<!-- end daftar hadir  -->
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><i class="ti ti-square-x"></i> Batal</button>
        <button type="submit" id="btn-save-kehadiran" class="btn btn-success"><i class="ti ti-checkbox"></i> Simpan Kehadiran</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script>
$(document).ready(function () {
    var isAllChecked = false;

    function toggleAllCheckboxes() {
        // Toggle the isAllChecked state
        isAllChecked = !isAllChecked;

        // Set the switch state based on the isAllChecked value
        $("#hadir_all").prop("checked", isAllChecked);

        // Set all checkboxes with class "hadir" based on the isAllChecked value
        $(".hadir").prop("checked", isAllChecked);
        $(".no_hadir").prop("checked", false);
        
        // Update summary
        updateSummary();
    }

    function updateSummary() {
        var jumlahHadir = $(".form-check-input.ket[value='H']:checked").length;
        var jumlahTidakHadir = $(".form-check-input.ket:not([value='H']):checked").length;

        $("#jumlahHadir").val(jumlahHadir);
        $("#jumlahTidakHadir").val(jumlahTidakHadir);
    }

    // Ketika switch "Hadir Semua" di-klik
    $("#hadir_all").on("click", function() {
        toggleAllCheckboxes();
    });

    // Hanya satu checkbox dalam setiap baris yang dapat dipilih
    $(".form-check-input").on("click", function() {
        var row = $(this).closest("tr");
        row.find(".form-check-input").not(this).prop("checked", false);
        
        // Update summary
        updateSummary();
    });

    $("#FormKehadiran").submit(function (event) {
        event.preventDefault(); // Mencegah submit reguler

        // Ambil data form
        var formData = $(this).serialize();

        // Kirim data ke server dengan Ajax
        $.ajax({
            url: "<?php echo site_url('teacher/jurnal/presensi/save'); ?>", // Gunakan helper site_url() untuk mendapatkan URL metode di controller
            method: "POST",
            data: formData,
            dataType: 'json', // Tambahkan dataType json agar data yang dikirim ke server dalam bentuk JSON
            beforeSend : function () {
              $('#btn-save-kehadiran').prop('disabled', true)
              $('#btn-save-kehadiran').html(`<div class="d-flex align-items-center">
  <strong role="status">Loading...</strong>
  <div class="spinner-border ms-auto" aria-hidden="true"></div>
</div>`)
              
            },
            complete : function () {
              $('#btn-save-kehadiran').prop('disabled', false)
              $('#btn-save-kehadiran').html(`<i class="ti ti-checkbox"></i> Simpan Kehadiran`)
              
            },
            success: function (response) {
                // Tanggapi respons dari server (opsional)
                if (response.error) {
                    if (response.error.pilihan) {
                        // Validasi setiap baris untuk memastikan ada setidaknya satu checkbox yang dipilih
                        var isValid = true;
                        $("tbody tr").each(function () {
                            var checkboxes = $(this).find(".form-check-input:checked");
                            if (checkboxes.length === 0) {
                                isValid = false;
                                // Tandai baris yang tidak valid, misalnya dengan memberikan warna latar belakang merah
                                $(this).addClass("table-danger");
                            } else {
                                $(this).removeClass("table-danger");
                            }
                        });

                        Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            text: response.error.pilihan,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                }

                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Selesai',
                        text: response.msg,
                    }).then((result) => {
                        // Tambahkan aksi setelah data berhasil diupdate (opsional)
                        DaftarAgenda()
                        RekapPresensi()
                        $('#modal-presensi').modal('hide')
                    });
                }
            },
            error: function (xhr, status, error) {
                // Tanggapi kesalahan (opsional)
                console.error(error);
            }
        });
    });

    // Update summary on page load
    updateSummary();
});
</script>
