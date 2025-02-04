<?php 
// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login
if (empty($_SESSION['antrian_user_account_name']) && empty($_SESSION['antrian_user_account_password'])){
    echo "<meta http-equiv='refresh' content='0; url=../../login-error'>";
}
// jika user sudah login, maka jalankan perintah untuk insert, update, dan delete
else { ?>
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-1">
            <h3 class="content-header-title"><i class="icon-database"></i> Backup Database </h3>
        </div>

        <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="beranda"><i style="margin-right:7px" class="icon-home3"></i> Beranda</a></li>
                    <li class="breadcrumb-item active">Database</li>
                    <li class="breadcrumb-item active">Backup</li>
                </ol>
            </div>
        </div>
    </div>

    <?php
    // fungsi untuk menampilkan pesan
    // jika alert = "" (kosong)
    // tampilkan pesan "" (kosong)
    if (empty($_GET['alert'])) {
    }
    // jika alert = 1
    // tampilkan pesan "Backup Database berhasil"
    elseif ($_GET['alert'] == 1) { ?>
        <div class="alert alert-success alert-dismissible fade in mb-2" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong><i style="margin-right:7px" class="icon-checkmark2"></i>Sukses!</strong> Backup database berhasil.
        </div>
    <?php
    }   
    // jika alert = 2
    // tampilkan pesan "Backup database berhasil dihapus"
    elseif ($_GET['alert'] == 2) { ?>
        <div class="alert alert-success alert-dismissible fade in mb-2" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong><i style="margin-right:7px" class="icon-checkmark2"></i>Sukses!</strong> Backup database berhasil dihapus.
        </div>
    <?php
    }   
    ?>

    <div class="content-body">
        <div class="row">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <a><i style="margin-right:5px" class="icon-info"></i> Klik tombol "Backup Database" untuk backup semua data pada database.</a>
                        <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="card-body collapse in">
                        <div class="card-block card-dashboard">
                            <a href="backup-database-proses" class="btn btn-primary"><i style="margin-right:5px" class="icon-download"></i> Backup Database </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Basic Tables start -->
        <div class="row">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Data Backup Database</h6>
                        <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                                <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body collapse in">
                        <div class="card-block card-dashboard">
                            <table id="tabel-backup" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama File</th>
                                        <th>Tanggal Backup</th>
                                        <th>Ukuran File</th>
                                        <th></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Basic Tables end -->
    </div>

    <!-- datatables serverside processing -->
    <script type="text/javascript">
    $(document).ready(function() {
        // initiate dataTables plugin
        $.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings)
        {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };

        var table = $('#tabel-backup').DataTable( {
            "bAutoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": 'modules/backup-database/data.php',
            "columnDefs": [ 
                { "targets": 0, "data": null, "orderable": false, "searchable": false, "width": '40px', "className": 'center' },
                { "targets": 1, "width": '200px' },
                { "targets": 2, "width": '150px', "className": 'center' },
                { "targets": 3, "width": '120px', "className": 'center' },
                {
                  "targets": 4, "data": null, "orderable": false, "searchable": false, "width": '80px', "className": 'center',
                  "render": function(data, type, row) {
                      var btn = "<a style=\"margin-right:5px\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Download\" class=\"btn btn-primary btn-sm\" href=\"../database/"+data[ 1 ]+"\"><i class=\"icon-download\"></i></a><span><a data-toggle=\"tooltip\" data-placement=\"top\" title=\"Hapus\" class=\"btn btn-danger btn-sm\" href=\"backup-database-delete-"+data[ 4 ]+"\"><i class=\"icon-bin\"></i></a></span>";
                      return btn;
                  } 
                } 
            ],
            "order": [[ 2, "desc" ]],
            "iDisplayLength": 10,
            "rowCallback": function (row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        } );
     
        $('#tabel-backup tbody').on( 'click', 'span', function () {
            var data = table.row( $(this).parents('tr') ).data();
            return confirm("Anda yakin ingin menghapus backup database "+ data[ 1 ] );
        } );
    } );
    </script>
<?php  
}
?>