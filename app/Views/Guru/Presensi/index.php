<?= $this->extend('Guru/Layouts') ?>
<?= $this->section('content') ?>
<p>
    <button onclick="BuatKelas()" class="btn btn-light"><i class="ti ti-plus"></i> Buat Kelas</button>
</p>
<!-- <div class="card shadow-sm">
    <div class="card-body">
    <h5 class="card-title fw-semibold mb-4">History Mencatat Pelanggaran</h5>
</div>
</div> -->
<div id="list-kelas"></div>
<div class="viewmodal"></div>
<script>
    $(document).ready(function () {
        TableKelas()
    });
    function TableKelas() {
        $.ajax({
            url: "<?=base_url('teacher/kelas')?>",
            data: "data",
            dataType: "json",
            success: function (response) {
                $('#list-kelas').html(response.table_kelas)
            }
        });
    }
    function BuatKelas(){
        $.ajax({
            url: "<?=base_url('teacher/kelas/add')?>",
            data: "data",
            dataType: "json",
            success: function (response) {
                $('.viewmodal').html(response.form_kelas)
                $('#modal-kelas').modal('show')
            }
        });
    }
</script>
<?= $this->endSection() ?>