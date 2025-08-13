
<div class="row mt-3">
    <div class="col-lg-9">
        <div class="alert alert-light">
        <table class="table table-hover table-sm" style="text-transform: uppercase;font-size:12px">
        <tr>
        <td>TP</td>
        <td>:</td>
        <td><?=$rombel->nm_periode?></td>
        </tr>
        <tr>
        <td>Sekolah</td>
        <td>:</td>
        <td><?=$rombel->nm_sekolah?> (<?=$rombel->kepsek?>) </td>
        </tr>
       
        <tr>
        <td>Kelas</td>
        <td>:</td>
        <td><?=$rombel->level_kelas?> (<?=$rombel->rombel?>)</td>
        </tr>
    
        <tr>
        <td>Walas</td>
        <td>:</td>
        <td><?=$rombel->walas?></td>
        </tr>
        </table>
        </div>
    </div>
    <div class="col-lg-3">
    <div class="card border border-primary text-center shadow-sm">
            <!-- <div class="card-header bg-primary text-white">
            <h1><i class="ti ti-users text-white"></i></h1>
            Jumlah siswa melanggar
            <div>
               <?php
                 $jml = JumlahSiswaMelanggarBySekolah($rombel->sekolah_id);

               ?>
                <b><?=$jml?></b>
            </div>
            </div> -->
            <div class="card-body p-2">
                <div class="d-grid gap-2">
                <a class="btn btn-secondary btn-sm" href="" target="_blank"> <i class="ti ti-printer"></i> Print </a>
                <a class="btn btn-dark btn-sm" href="#" onclick="AddNewSiswa(<?=$rombel->id?>)"> <i class="ti ti-plus"></i> Add </a>
                <button id="btn-upload" class="btn btn-success btn-sm"> <i class="ti ti-upload"></i> Upload Siswa </button>
              
                </div>  
                
                <div id="area-upload" class="d-none mt-3">
                <form id="form-upload-file" enctype="multipart/form-data">
                    <?=csrf_field();?>
                    <input type="hidden" name="rombel_id" value="<?=$rombel->id?>">
                <div class="mb-2">
                <label for="formFileSm" class="form-label">Uplod File disini</label>
                <input class="form-control form-control-sm" name="file_excel" id="formFileSm" type="file">
                </div>
                <a href="<?=base_url('public/template/template_siswa.xls')?>" target="_blank" class="btn btn-outline-success btn-sm"> <i class="ti ti-download"></i></a>
                <button type="submit" class="btn btn-success btn-sm"> <i class="ti ti-upload"></i> Upload File </button>
                <a href="" class="btn btn-warning btn-sm">Batal</a>
                </form>
              
                </div>
            </div>
        </div>

    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true"><h5><i class="ti ti-users"></i> Data Siswa</h5></button>
        </li>
        <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false"><h5><i class="ti ti-users"></i> Pelanggaran</h5></button>
        </li>
   
        </ul>
        <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

        <!-- // DATA SISWA  -->
        <div class="table-responsive mt-3">
<!-- <p>
    <h4><i class="ti ti-users"></i> Data Siswa</h4>
</p> -->
<!-- btn area  -->
<div id="btn-area" class="mb-3" style="display: none;">
    <!-- <form id="move-rombel"> -->
 
    <div class="row">
        <div class="col-lg-3">

<button id="hapusBtn" class="btn btn-danger btn-sm"><i class="ti ti-trash"></i> Hapus Siswa</button>
<button id="ShowPindahBtn" class="btn btn-info btn-sm"><i class="ti ti-hand-move"></i> Pindah/Naik Kelas</button>
<button id="HidePindahBtn" class="btn btn-warning btn-sm d-none"><i class="ti ti-square-x"></i> Batal</button>
    </div>
    <div class="col-lg-9">
<div class="row d-none" id="opsi-btn-pindah">    
<div class="col-lg-3">
    <div class="input-group input-group-sm mb-1">
    <span class="input-group-text"><i class="ti ti-calendar"></i></span>
    <select class="form-select periode">
    <option value="">Tahun Pelajaran</option>
    <?php
    if (ListOfPeriode()) {
    foreach (ListOfPeriode() as $p) {
    ?>
    <option value="<?=$p['id']?>" <?=$p['status_periode']==1 ?'selected':null ?> ><?=$p['nm_periode']?> <?=$p['status_periode']==1 ?'(Aktif)':null ?></option>
    <?php
    }
    }
    ?>
    </select>
    </div>
    </div>
    <div class="col-lg-3">
    <div class="input-group input-group-sm mb-1">
    <span class="input-group-text"><i class="ti ti-list"></i></span>
    <select class="form-select sekolah">
    <option value="">Sekolah / Madrasah</option>
    <?php
    if (ListOfSekolah()) {
    foreach (ListOfSekolah() as $p) {
    ?>
    <option value="<?=$p['id']?>"><?=$p['nm_sekolah']?></option>
    <?php
    }
    }
    ?>
    </select>
    </div>
    </div>
    <div class="col-lg-3">
    <div class="input-group input-group-sm mb-1">
    <span class="input-group-text"><i class="ti ti-list"></i></span>
    <select class="form-select kelas" disabled><option value="">Tingkat Kelas</option></select>
    </div>
    </div>

    <div class="col-lg-3">
    <div class="input-group input-group-sm mb-1">
    <span class="input-group-text"><i class="ti ti-list"></i></span>
    <select class="form-select rombel" name="rombel" disabled>
    <option value="">Rombel</option>
    </select>
    <button type="submit" class="btn btn-info" id="btn-move-siswa"><i class="ti ti-replace"></i> Move</span>
    </div>
    </div>

</div>
<!-- </form> -->

    </div>
</div>
</div>
<table class="table table-sm table-bordered table-hover mid">
    <thead>
        <tr>
            <th>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="all">
                    <label class="form-check-label" for="all">
                        All
                    </label>
                </div>
            </th>
            <th class="text-center">No.</th>
            <th>NISN</th>
            <th>NAMA</th>
            <th>JK</th>
            <th>
                <i class="ti ti-cog"></i>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;

        if ($siswa) {
            foreach ($siswa as $s) {
                ?>
                <tr>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input item-checkbox" type="checkbox" value="<?=$s['id']?>" id="item-<?=$s['id']?>">
                            <label class="form-check-label" for="item-<?=$s['id']?>"></label>
                        </div>
                    </td>
                    <td class="text-center"><?=$i++?>.</td>
                    <td><?=$s['nisn']?></td>
                    <td><?=$s['nama_siswa']?></td>
                    <td><?=$s['jk']?></td>
                    <td>
                    <a href="#" class="badge rounded-pill text-bg-primary" onclick="LihatDetailPelanggaran(<?=$s['id']?>)"><i class="ti ti-folders"></i> Riwayat Pelanggaran</a>
                    <a href="#" class="badge rounded-pill text-bg-warning" onclick="EditSiswa(<?=$s['siswa_id']?>)"><i class="ti ti-edit"></i></a>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo "<tr>
            <td class='text-center text-bold text-danger' colspan='6'>Belum ada siswa pada rombel ini</td>
            </tr>";
        }
        ?>
    </tbody>
</table>
</div>
        <!-- // DATA SISWA  -->


        </div>
        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
          
            <div id="section-pelanggaran-kelas"></div>

            
        </div>
     
        </div>
    </div>
</div>






<div class="modalview"></div>

<script>
//     $(document).ready(function () {
// $('#tabel-siswa-rombel').DataTable();
// });
    $(document).ready(function() {
        RiwayatPelanggaranSiswaKelas()


        // Event saat checkbox "All" di-klik
        $('#all').change(function() {
            $('.item-checkbox').prop('checked', $(this).prop('checked'));
            toggleHapusButton();
        });

        // Event saat checkbox item di-klik
        $('.item-checkbox').change(function() {
            toggleHapusButton();
        });

        // Fungsi untuk menampilkan atau menyembunyikan tombol hapus
        function toggleHapusButton() {
            var checked = $('.item-checkbox:checked').length > 0;
            if (checked) {
                $('#btn-area').show();
            } else {
                $('#btn-area').hide();
            }
        }

        // Ajax untuk menghapus item yang tercentang
        $('#hapusBtn').click(function() {
                Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                if (result.isConfirmed) {

                var ids = $('.item-checkbox:checked').map(function() {
                return this.value;
                }).get();

                $.ajax({
                url: '<?=base_url('admin/student/delete')?>',
                method: 'POST',
                data: {
                    rombel_id : <?=$rombel->id?>,
                    ids: ids
                
                },
                success: function(response) {
                // Handle response if needed
                // Misalnya, reload tabel siswa setelah hapus
                Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success"
                }).then((result) => {
                    // location.reload();
                    LoadSiswaRombel(<?=$rombel->id?>)

                });
                },
                error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                }
                });



                }
                });


          
        });

        // Pindahkan siswa terpilih 

        $('#btn-move-siswa').click(function (e) { 
            e.preventDefault();

                Swal.fire({
                title: "Konfirmasi Pemindahan Siswa?",
                text: "Data siswa akan dipindahkan ke rombel ini",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Pindahkan Sekarang"
                }).then((result) => {
                if (result.isConfirmed) {
                    var siswaID = $('.item-checkbox:checked').map(function() {
                    return this.value;
                    }).get();

                    $.ajax({
                    url: '<?=base_url('admin/student/move')?>',
                    method: 'POST',
                    data: { 
                    rombel_id : $('.rombel').val(),
                    ids: siswaID },
                    success: function(response) {
                    // console.log(response);
                            if (response.status=='error') {
                            Swal.fire({
                            title: "Warning!",
                            text: response.message,
                            icon: "warning"
                            });

                            }else{
                            $.each(response, function(index, item) {
                            var row = $('#item-' + item.id).closest('tr');
                            if (item.status == 'duplicate') {
                            row.addClass('table-danger'); // Ganti warna baris jika duplicate
                            } else {
                            row.addClass('table-success'); // Ganti warna baris jika berhasil dipindahkan
                            LoadSiswaRombel(<?=$rombel->id?>)
                            }
                            });
                            }

              
                    },
                    error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    }
                    });
              
                }
                });
            
            
        });
    });



    // UPLOAD SISWA 

    $('#btn-upload').click(function (e) { 
        e.preventDefault();
        $('#area-upload').removeClass('d-none')
        $(this).addClass('d-none')
        
    });

    // Action Upload 

    $('#form-upload-file').submit(function (e) { 
        e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
            url: '<?= base_url('admin/student/upload') ?>',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json", 
            success: function(response) {
            console.log(response);
            // Tampilkan pesan atau lakukan manipulasi UI sesuai kebutuhan
            if (response.status==false) {
            if (response.rombel_id) {
            alert(response.rombel_id)  
            }else  if (response.file_excel) {
            alert(response.file_excel) 
            }   
            }

            if (response.status==true) {
             Swal.fire({
             icon: "success",
             title: "Berhasil",
             text: "Template Siswa berhasil di import",
             showConfirmButton: false,
            timer: 1500
             }).then((result) => {
                LoadSiswaRombel(<?=$rombel->id?>)

             }); 
        }
   
            },
            error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
            }
            });
        
    });
</script>




<script>

    // tampilkan opi kelas pindah 

    $('#ShowPindahBtn').click(function (e) { 
        e.preventDefault();
        $('#opsi-btn-pindah').removeClass('d-none')
        $('#ShowPindahBtn').addClass('d-none')
        $('#HidePindahBtn').removeClass('d-none')
        
        // $(selector).removeClass(className);
    });
    $('#HidePindahBtn').click(function (e) { 
        e.preventDefault();
        $('#ShowPindahBtn').removeClass('d-none')
        $('#opsi-btn-pindah').addClass('d-none')
        $('#HidePindahBtn').addClass('d-none')

        // $(selector).removeClass(className);
    });

    $('.periode').change(function (e) { 
        e.preventDefault();
        if ($(this).val()=="") {
            $('.kelas').prop('disabled', true) 
            $('.rombel').prop('disabled', true)
            $('.kelas').html('<option value="">Tingkat Kelas</option>')
            $('.rombel').html('<option value="">Rombel</option>')
        }else{
            $('.kelas').prop('disabled', false) 
            $('.rombel').prop('disabled', false)
        }

        
    });
    



        // GET KELAS LEVEL
$('.sekolah').change(function (e) { 
    e.preventDefault();
   $.ajax({
    url: "<?=base_url('master/kelas-level')?>",
    data: {sekolah_id: $(this).val()},
    dataType: "json",
    success: function (response) {
       $('.kelas').prop('disabled', false)
       $('.kelas').html('<option value="">Tingkat Kelas</option>'+response.kelas_level)
    }
   });
    
});

// GET ROMBEL
$('.kelas').change(function (e) { 

    e.preventDefault();
   $.ajax({
    url: "<?=base_url('master/kelas-rombel')?>",
    data: {
        periode_id: $('.periode').val(),
        level_id: $(this).val(),
    },
    dataType: "json",
    success: function (response) {
       $('.rombel').prop('disabled', false)
       $('.rombel').html('<option value="">Pilih Rombel</option>'+response.kelas_rombel)
    }
   });
    
});

</script>

<script>
    function LihatDetailPelanggaran(id) {
        $.ajax({
            url: "<?=base_url('admin/pelanggaran/detail')?>",
            data: {id:id},
            dataType: "json",
            success: function (response) {
                $('.modalview').html(response.view).show()
                $('#modal-info').modal('show')

            }
        });   
    }

    function AddNewSiswa(rombel_id) { 
        $.ajax({
            url: "<?=base_url('admin/student/add')?>",
            data: {
                rombel_id : rombel_id
            },
            dataType: "json",
            success: function (response) {
                $('.viwmodalsiswa').html(response.view);
                $('#modal-siswa').modal('show')
            }
        });
     }
    function EditSiswa(siswa_id) { 
        $.ajax({
            url: "<?=base_url('admin/student/edit')?>",
            data: {
                siswa_id : siswa_id,
                rombel_id : <?=$rombel->id?>,
            },
            dataType: "json",
            success: function (response) {
                $('.viwmodalsiswa').html(response.view);
                $('#modal-siswa').modal('show')
            }
        });

     }

     function RiwayatPelanggaranSiswaKelas() { 
        $.ajax({
            url: "<?=base_url('admin/pelanggaran/kelas/all')?>",
            data: {rombel: <?=json_encode($rombel->id)?>},
            dataType: "json",
            success: function (response) {
                $('#section-pelanggaran-kelas').html(response.pelanggaran_rombel)
            }
        });
      }
</script>