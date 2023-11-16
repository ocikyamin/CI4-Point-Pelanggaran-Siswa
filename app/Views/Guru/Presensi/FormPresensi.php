<?= $this->extend('Guru/Layouts') ?>
<?= $this->section('content') ?>
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
<div class="row">
    <div class="col-lg-10">
        <div class="alert alert-light p-0">
        <table class="table-sm w-100" style="text-transform: uppercase;font-size:12px">
            <tr class="shadow-sm">
            <td>Bidang Studi</td>
            <td>:</td>
            <td><?=$kelas->mapel?></td>
            </tr>
            <tr class="shadow-sm">
            <td>Kelas</td>
            <td>:</td>
            <td><?=$kelas->level_kelas?> - <?=$kelas->rombel?></td>
            </tr>
            <tr class="shadow-sm">
            <td>Guru Pengampu</td>
            <td>:</td>
            <td><?=$kelas->nm_guru?></td>
            </tr>
            <tr class="shadow-sm">
            <td>Tahun Pelajaran / Semester</td>
            <td>:</td>
            <td><?=$kelas->nm_periode?> / <?=$kelas->semester?></td>
            </tr>
        </table>
        </div>
    </div>
    <div class="col-lg-2">
        <!-- <a href="" class="btn btn-success"><i class="ti ti-printer"></i> Cetak Presensi</a> -->
        <table style="font-size:11px">
            <tr>
                <td>H </td>
                <td> = </td>
                <td> Hadir</td>
            </tr>
            <tr>
                <td>S </td>
                <td> = </td>
                <td> Sakit</td>
            </tr>
            <tr>
                <td>I </td>
                <td> = </td>
                <td> Izin</td>
            </tr>
            <tr>
                <td>T </td>
                <td> = </td>
                <td> Terlambat</td>
            </tr>
            <tr>
                <td>A </td>
                <td> = </td>
                <td> Absen</td>
            </tr>
            <tr>
                <td>C </td>
                <td> = </td>
                <td> Cabut</td>
            </tr>
        </table>
    </div>
</div>
<div class="row">
<div class="col-lg-12">
    <!-- tabs  -->
        <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <button class="nav-link bg-light shadow-sm mr-3 active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><i class="ti ti-checklist"></i> Daftar Kehadiran</button>
        <button class="nav-link bg-light shadow-sm" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false"> <i class="ti ti-file-analytics"></i> Rekap Kehadiran</button>
        </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
<div class="mb-3 mt-3 alert alert-warning">
Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt ipsam praesentium fuga saepe repellat deserunt velit impedit ad similique deleniti, nulla ipsa necessitatibus sint dolorum nihil fugiat harum minus. Eos.
</div>
                <!-- Daftar Hadir  -->
                <div class="table-responsive">
                <form id="presensiForm" action="" method="post">
                    <?php
                    var_dump($last);
                    // $status = StatusPresensiToday();
                    ?>
                <input type="hidden" name="mapel_mengajar_id" value="<?=$kelas->id?>">
                <div class="row mb-2">
                <div class="col-lg-12">

                <div class="form-group row">
                <label class="col-lg-1" for="">Tanggal</label>
                <div class="col-lg-3">
                <input type="date" name="tanggal" class="form-control" value="<?=date('Y-m-d')?>">
                </div>

                <label class="col-lg-1" for="">Jam Ke-</label>
                <div class="col-lg-2">
                <input type="text" name="jam_ke" class="form-control" value="<?=!empty($last->jam_ke)?>" placeholder="07.15 - 08.15">
                </div>

                <label class="col-lg-1" for="">Pertemuan</label>
                <div class="col-lg-2">
                <input type="text" name="pertemuan_ke" class="form-control" value="<?=!empty($last->pertemuan_ke)? $last->pertemuan_ke+1:1?>" placeholder="(0)">
                </div>
                <div class="col-lg-2">
                <div class="form-check form-switch mb-2">
                <input class="form-check-input" type="checkbox" role="switch" id="hadir_all" style="cursor:pointer;">
                <label class="form-check-label" for="hadir_all" style="cursor:pointer">Hadir Semua</label>
                </div>
                <div class="d-grid">
                <button type="submit" id="btn-kirim-presensi" class="btn btn-success"><i class="ti ti-brand-telegram"></i> KIRIM</button>

                </div>
              
                </div>


                </div>
                </div>
                </div>



                <table class="table table-sm table-bordered">
                <thead>
                <tr>
                <th width="1" class="text-center">NO</th>
                <th>NAMA LENGKAP SISWA</th>
                <th>KEHADIRAN</th>
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
                    ?>
                <input type="hidden" name="siswa[]" value="<?=$d['id']?>">
                <tr>
                <td class="text-center"><?=$no++?></td>
                <td><?=$d['nama_siswa']?></td>
                <td width="1">H</td>
                <td>
                <div class="form-check">
                <input class="form-check-input ket shadow-sm hadir" type="checkbox" name="ket[]" id="h-<?=$d['id']?>" value="H">
                <label class="form-check-label" for="h-<?=$d['id']?>"></label>
                </div>
                </td>
                <td>
                <div class="form-check">
                <input class="form-check-input ket no_hadir shadow-sm" type="checkbox" name="ket[]" id="s-<?=$d['id']?>" value="S">
                <label class="form-check-label" for="s-<?=$d['id']?>"></label>
                </div>
                </td>
                <td>
                <div class="form-check">
                <input class="form-check-input ket no_hadir shadow-sm" type="checkbox" name="ket[]" id="i-<?=$d['id']?>" value="I">
                <label class="form-check-label" for="i-<?=$d['id']?>"></label>
                </div>
                </td>
                <td>
                <div class="form-check">
                <input class="form-check-input ket no_hadir shadow-sm" type="checkbox" name="ket[]" id="t-<?=$d['id']?>" value="T">
                <label class="form-check-label" for="t-<?=$d['id']?>"></label>
                </div>
                </td>
                <td>
                <div class="form-check">
                <input class="form-check-input ket no_hadir shadow-sm" type="checkbox" name="ket[]" id="a-<?=$d['id']?>" value="A">
                <label class="form-check-label" for="a-<?=$d['id']?>"></label>
                </div>
                </td>
                <td>
                <div class="form-check">
                <input class="form-check-input ket no_hadir shadow-sm" type="checkbox" name="ket[]" id="c-<?=$d['id']?>" value="C">
                <label class="form-check-label" for="c-<?=$d['id']?>"></label>
                </div>
                </td>

                </tr>
                <?php } ?>
                </tbody>
                </table>
                <input type="hidden" id="jml_siswa" value="<?=$no-1?>">
                </form>
                </div>
            <!-- end daftar hadir  -->

        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">...</div>
        </div>
    <!-- tabs  -->

</div>
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

    // // Hanya satu checkbox dalam setiap baris yang dapat dipilih
    // $(".form-check-input").on("click", function() {
    // var row = $(this).closest("tr");
    // row.find(".form-check-input").not(this).prop("checked", false);
    // });

    $("#presensiForm").submit(function (event) {
        event.preventDefault(); // Mencegah submit reguler

        // Ambil data form
        var formData = $(this).serialize();
        // var ket = [];

        // // Ambil data checkbox yang dipilih dan tambahkan ke dalam array 'ket'
        // $(".form-check-input:checked").each(function () {
        //     ket.push($(this).val());
        // });
        // // Tambahkan data 'ket' ke formData
        // formData.push({ name: "ket[]", value: ket });

        // Kirim data ke server dengan Ajax
        $.ajax({
            url: "<?php echo site_url('teacher/presensi/save'); ?>", // Gunakan helper site_url() untuk mendapatkan URL metode di controller
            method: "POST",
            data: formData,
            dataType: 'json', // Tambahkan dataType json agar data yang dikirim ke server dalam bentuk JSON
            success: function (response) {
                // Tanggapi respons dari server (opsional)
                if (response.error) {
                   if (response.error.tanggal) {
                        Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: response.error.tanggal,
                        showConfirmButton: false,
                        timer: 1500
                        })
                   } 
                   if (response.error.jam_ke) {
                        Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: response.error.jam_ke,
                        showConfirmButton: false,
                        timer: 1500
                        })
                   } 
                   if (response.error.pertemuan_ke) {
                        Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: response.error.pertemuan_ke,
                        showConfirmButton: false,
                        timer: 1500
                        })
                   } 
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
                        })
                   } 
                }
                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Selesai',
                        text: response.msg,
                        // showConfirmButton: false,
                        // timer: 1500
                        })
                }

          
                console.log(response);
            },
            error: function (xhr, status, error) {
                // Tanggapi kesalahan (opsional)
                console.error(error);
            }
        });
    });
});
</script>
<?= $this->endSection() ?>