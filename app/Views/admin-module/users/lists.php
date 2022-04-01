<?= $this->extend('App\Views\admin-module\skeleton') ?>

<?= $this->section('content') ?>
<header class="blue accent-3 relative nav-sticky">
        <div class="container-fluid text-white">
            <div class="row">
                <div class="col">
                    <h3 class="my-3">
                        <i class="icon icon-users"></i>
                        Data User Admin
                    </h3>
                </div>
            </div>
        </div>
    </header>
    <div class="container-fluid my-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card my-3 no-b">
                    <div class="card-body">
                        <button type="button" class="btn btn-primary btn-lg r-20"><i class="icon-plus mr-2"></i>Tambah Admin</button>
                        <hr>
                        <table id="table" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->endSection() ?>

    <?= $this->section('footer') ?>

    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script> -->
<script>
    var tbl;
    $(document).ready(function() {
        tbl = $('#table').DataTable( {
            dom: 'lfrtip',
            processing: true,
            serverSide: true,
            order: [], //init datatable not ordering
            ajax: "<?= base_url('admin/users/lists') ?>",
            columnDefs: [
                {
                    targets: 4,
                    render: function(data, type, full, meta) {
                        let res = "";
                        if(type === 'display'){
                            if(full[4] == 1){
                                res += `<span class="text-success">Aktif</span>`;
                            }else{
                                res += `<span class="text-danger">Non-Aktif</span>`;
                            }
                        }
                        return res;
                    }
                },
                {
                    targets: 6,
                    render: function(data, type, full, meta) {
                        let res = "";
                        if(type === 'display'){
                            res += `
                                <a href='<?= base_url('admin/users/edit') ?>/${full[6]}' class="text-success">Edit</a>
                            `;
                        }
                        return res;
                    }
                }
            ]
        } );
    } );
</script>
<?= $this->endSection() ?>