<?php  
// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login
if (empty($_SESSION['antrian_user_account_name']) && empty($_SESSION['antrian_user_account_password'])){
    echo "<meta http-equiv='refresh' content='0; url=../../login-error'>";
}
// jika user sudah login, maka jalankan perintah untuk insert, update, dan delete
else {
?>
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-1">
            <h3 class="content-header-title"><i class="icon-user"></i> Manajemen User </h3>
        </div>

        <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="beranda"><i style="margin-right:7px" class="icon-home3"></i> Beranda</a></li>
                    <li class="breadcrumb-item active">User</li>
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
    // tampilkan pesan "user baru berhasil disimpan"
    elseif ($_GET['alert'] == 1) { ?>
        <div class="alert alert-success alert-dismissible fade in mb-2" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong><i style="margin-right:7px" class="icon-checkmark2"></i>Sukses!</strong> User baru berhasil disimpan.
        </div>
    <?php
    } 
    // jika alert = 2
    // tampilkan pesan Sukses "data user berhasil diubah"
    elseif ($_GET['alert'] == 2) { ?>
        <div class="alert alert-success alert-dismissible fade in mb-2" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong><i style="margin-right:7px" class="icon-checkmark2"></i>Sukses!</strong> Data user berhasil diubah.
        </div>
    <?php
    }
    // jika alert = 3
    // tampilkan pesan Sukses "data user berhasil dihapus"
    elseif ($_GET['alert'] == 3) { ?>
        <div class="alert alert-success alert-dismissible fade in mb-2" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong><i style="margin-right:7px" class="icon-checkmark2"></i>Sukses!</strong> Data user berhasil dihapus.
        </div>
    <?php
    } 
    // jika alert = 4
    // tampilkan pesan Gagal "username sudah ada"
    elseif ($_GET['alert'] == 4) { ?>
        <div class="alert alert-danger alert-dismissible fade in mb-2" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong><i style="margin-right:7px" class="icon-cancel-circle"></i>Gagal!</strong> 
            <?php 
            $user_account_name = $_GET['id'];
            // fungsi query untuk menampilkan data dari tabel sys_users
            $result = $mysqli->query("SELECT user_account_name FROM sys_users WHERE user_account_name='$user_account_name'")
                                      or die('Ada kesalahan pada query tampil data username: '.$mysqli->error);
            $data = $result->fetch_assoc();
            ?>
            Username <b><?php echo $data['user_account_name']; ?></b> sudah ada.
            <br>
        </div>
    <?php
    }   
    // jika alert = 5
    // tampilkan pesan Gagal "Data masih digunakan ditabel lain"
    elseif ($_GET['alert'] == 5) { ?>
        <div class="alert alert-danger alert-dismissible fade in mb-2" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong><i style="margin-right:7px" class="icon-cancel-circle"></i>Gagal!</strong> <br>
            <?php 
            $userID = $_GET['id'];
            // fungsi query untuk menampilkan data dari tabel sys_users
            $result = $mysqli->query("SELECT userID, user_account_name FROM sys_users WHERE userID='$userID'")
                                      or die('Ada kesalahan pada query tampil data user: '.$mysqli->error);
            $data = $result->fetch_assoc();
            ?>
            Username <b><?php echo $data['user_account_name']; ?></b> tidak bisa dihapus karena username tersebut sudah tercatat pada data lain.
            <br>
        </div>
    <?php
    }
    ?>

    <div class="content-body"><!-- Basic Tables start -->
        <div class="row">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><a href="user-add" class="btn btn-primary"><i class="icon-plus"></i> Tambah </a></h4>
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
                            <table id="tabel-user" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama User</th>
                                        <th>Username</th>
                                        <th>Hak Akses</th>
                                        <th>Blokir User</th>
                                        <th>Terakhir Login</th>
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

        var table = $('#tabel-user').DataTable( {
            "bAutoWidth": false,
            "processing": true,
            "serverSide": true,
            "ajax": 'modules/user/data.php',
            "columnDefs": [ 
                { "targets": 0, "data": null, "orderable": false, "searchable": false, "width": '30px', "className": 'center' },
                { "targets": 1, "width": '200px' },
                { "targets": 2, "width": '160px' },
                { "targets": 3, "width": '120px', "className": 'center' },
                { "targets": 4, "width": '90px', "className": 'center' },
                { "targets": 5, "width": '130px', "className": 'center' },
                {
                  "targets": 6, "data": null, "orderable": false, "searchable": false, "width": '80px', "className": 'center',
                  "render": function(data, type, row) {
                      var btn = "<a style=\"margin-right:5px\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Ubah\" class=\"btn btn-primary btn-sm\" href=\"user-update-"+data[ 6 ]+"\"><i class=\"icon-pencil2\"></i></a><span><a data-toggle=\"tooltip\" data-placement=\"top\" title=\"Hapus\" class=\"btn btn-danger btn-sm\" href=\"user-delete-"+data[ 6 ]+"\"><i class=\"icon-bin\"></i></a></span>";
                      return btn;
                  } 
                } 
            ],
            "order": [[ 1, "asc" ]],
            "iDisplayLength": 10,
            "rowCallback": function (row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        } );
     
        $('#tabel-user tbody').on( 'click', 'span', function () {
            var data = table.row( $(this).parents('tr') ).data();
            return confirm("Anda yakin ingin menghapus username "+ data[ 2 ] +" ?" );
        } );
    } );
    </script>
<?php  
}
?>