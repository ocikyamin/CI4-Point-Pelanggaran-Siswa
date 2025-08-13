<div class="table-responsive">
    <table class="table table-sm table-hover table-bordered">
        <thead>
            <tr>
                <th>TINGKAT KELAS</th>
                <th>WALAS</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($level as $l): ?>
            <tr>
                <td colspan="2"><b><?= strtoupper($l['level_kelas']) ?></b></td>
                <td>
                    <button class="addRombelWalas btn btn-primary btn-sm"
                            data-sekolah-id="<?= $sekolah ?>"
                            data-periode-id="<?= $periode ?>"
                            data-level-id="<?= $l['id'] ?>">
                        <i class="ti ti-plus"></i> Add Walas / Rombel
                    </button>
                </td>
            </tr>
            <?php if (empty(RombelByLevel($l['id'], $periode))): ?>
                <tr>
                    <td colspan="2">
                        <div class="text-danger text-center">Belum ada Guru Kelas</div>
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach (RombelByLevel($l['id'], $periode) as $r): ?>
                    <tr>
                        <td>
                            <button data-id="<?= $r['id'] ?>"
                            data-sekolah-id="<?= $sekolah ?>" class="btnEdit btn btn-light btn-sm"><i class="ti ti-edit text-info"></i></button>
                            <button 
                            data-rombel-id="<?= $r['id'] ?>"
                            data-sekolah-id="<?= $sekolah ?>"
                            data-periode-id="<?= $periode ?>" class="btnHapusRombel btn btn-light btn-sm"><i class="ti ti-trash text-danger"></i></button>
                            <?= $r['rombel'] ?>
                        </td>
                        <td><?= $r['nm_guru'] ?></td>
                        <td>
                            <a class="btn btn-light btn-sm text-primary"
                               href="<?= base_url('admin/walas/detail/' . $r['id']) ?>">
                                <i class="ti ti-search"></i> Siswa / Pelanggaran
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="view-formrombel"></div>
<script>
    $(document).ready(function() {

        // tambah rombel
        $('.addRombelWalas').click(function(e) {
            e.preventDefault();

            var sekolah_id = $(this).data('sekolah-id');
            var periode_id = $(this).data('periode-id');
            var level_id = $(this).data('level-id');

            $.ajax({
                url: '<?= base_url('admin/walas/add'); ?>',
                type: 'POST',
                data: {
                    sekolah_id: sekolah_id,
                    periode_id: periode_id,
                    level_id: level_id
                },
                dataType: 'json',
                success: function(response) {
                    // console.log(response);
                    // Handle success response

                    $('.view-formrombel').html(response.form_rombel_walas).show()
                    $('#modal-form-rombel').modal('show')
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    // Handle error response
                }
            });
        });

        // Edit Rombel


$('.btnEdit').click(function (e) { 
    e.preventDefault();
    var id = $(this).data('id');
    var sekolah_id = $(this).data('sekolah-id');
        $.ajax({
        type: "post",
        url: "<?= base_url('admin/walas/edit'); ?>",
        data: {
            id:id,
            sekolah:sekolah_id,
        },
        dataType: "json",
        success: function (response) {
            $('.view-formrombel').html(response.form_rombel_walas).show()
            $('#modal-form-rombel').modal('show')
        }
    });
    
});



        // Hapus Rombel
    $('.btnHapusRombel').click(function (e) { 
        e.preventDefault();
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
        var id = $(this).data('rombel-id');
        var sekolah_id = $(this).data('sekolah-id');
        var periode_id = $(this).data('periode-id');

            $.ajax({
                url: '<?= base_url('admin/walas/del'); ?>',
                type: 'POST',
                data: {
                    id: id,
                    sekolah_id: sekolah_id,
                    periode_id: periode_id,
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status==true) {
                        WalasPeriode(response.periode,response.sekolah)
                }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    // Handle error response
                }
            });
  }
});
        
    });


    });
</script>
