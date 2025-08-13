<?= $this->extend('SuperAdmin/Layouts') ?>
<?= $this->section('content') ?>
<nav aria-label="breadcrumb" class="mb-1">
<ol class="breadcrumb border border-info px-3 py-2 rounded">
<li class="breadcrumb-item">
<a href="#" class="text-info d-flex align-items-center"><i class="ti ti-layout-dashboard fs-4"></i></a>
</li>
<li class="breadcrumb-item active text-info font-medium" aria-current="page">
User Management
</li>
</ol>
</nav>

<!-- ---------------------
start Custom Icon Tab
---------------- -->
<div class="card">
    <div class="card-header">
    <!-- <h5 class="mb-0">User Management</h5> -->
    <ul class="nav nav-tabs" role="tablist">
<li class="nav-item">
<a
class="nav-link d-flex active"
data-bs-toggle="tab"
href="#gurus"
role="tab"
>
<span
><i class="ti ti-users fs-4"></i>
</span>
<span class="d-none d-md-block ms-2">Akun Guru</span>
</a>
</li>
<li class="nav-item">
<a
class="nav-link d-flex"
data-bs-toggle="tab"
href="#eksekutif"
role="tab">
<span
><i class="ti ti-user fs-4"></i>
</span>
<span class="d-none d-md-block ms-2">Super User</span>
</a>
</li>

</ul>
    </div>
<div class="card-body">

<!-- Nav tabs -->

<!-- Tab panes -->
<div class="tab-content">
<div class="tab-pane active" id="gurus" role="tabpanel">

<div class="alert mb-3 py-2 shadow mt-3">
    <button onclick="AddGuru()" class="btn btn-dark btn-sm mr-5"><i class="ti ti-plus"></i> New</button>
    <button onclick="ImportGuru()" class="btn btn-success btn-sm mr-5"><i class="ti ti-table-import"></i> Import</button>
<b><i class="ti ti-settings"></i></b> Akun Guru / Walas
</div>
<div id="guru-list"></div>
</div>

<div class="tab-pane p-3" id="eksekutif" role="tabpanel">

<div class="alert alert-info">
Pengaturan Akun
</div>
<div id="user-list"></div>
</div>

</div>
</div>
</div>
</div>
<!-- ---------------------
end Custom Icon Tab
---------------- -->
<div class="view-modal"></div>



<script>

function AddGuru() {

$.ajax({
    url: "<?=base_url('admin/users/guru/add')?>",
    data: "data",
    dataType: "json",
    success: function (response) {
        $('.view-modal').html(response.view).show()
        $('#guru-modal').modal('show')
    }
});
}
function ImportGuru() {

$.ajax({
    url: "<?=base_url('admin/users/guru/import')?>",
    data: "data",
    dataType: "json",
    success: function (response) {
        $('.view-modal').html(response.view).show()
        $('#guru-modal').modal('show')
    }
});
}



    function GuruList() {
    $.ajax({
        url: "<?=base_url('admin/users/guru')?>",
        data: "data",
        dataType: "json",
        success: function (response) {
            $('#guru-list').html(response.guru_table)
        }
    });
}
function UserList() {
    $.ajax({
        url: "<?=base_url('admin/users/super')?>",
        data: "data",
        dataType: "json",
        success: function (response) {
            $('#user-list').html(response.user_table)
        }
    });
}



$(document).ready(function () {
    UserList()
    GuruList()
});
</script>

<?= $this->endSection() ?>