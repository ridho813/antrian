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
            <h3 class="content-header-title"><i class="icon-lock"></i> Ubah Password </h3>
        </div>

        <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="beranda"><i style="margin-right:7px" class="icon-home3"></i> Beranda</a></li>
                    <li class="breadcrumb-item active">Password</li>
                    <li class="breadcrumb-item active">Ubah</li>
                </ol>
            </div>
        </div>
    </div>

    <?php  
    // fungsi untuk menampilkan pesan
    // jika alert = "" (kosong)
    // tampilkan pesan "" (kosong)
    if (empty($_GET['alert'])) { ?>
        <div></div>
    <?php
    }
    // jika alert = 1
    // tampilkan pesan Gagal "Paswword lama Anda salah"
    elseif ($_GET['alert'] == 1) { ?>
        <div class="alert alert-danger alert-dismissible fade in mb-2" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong><i style="margin-right:7px" class="icon-cancel-circle"></i>Gagal!</strong> Paswword lama Anda salah.
        </div>
    <?php
    } 
    // jika alert = 2
    // tampilkan pesan Sukses "Password baru dan ulangi password baru tidak cocok"
    elseif ($_GET['alert'] == 2) { ?>
        <div class="alert alert-danger alert-dismissible fade in mb-2" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong><i style="margin-right:7px" class="icon-cancel-circle"></i>Gagal!</strong> Password baru dan ulangi password baru tidak cocok.
        </div>
    <?php
    }
    // jika alert = 3
    // tampilkan pesan Sukses "Anda telah berhasil logout"
    elseif ($_GET['alert'] == 3) { ?>
        <div class="alert alert-success alert-dismissible fade in mb-2" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong><i style="margin-right:7px" class="icon-checkmark2"></i>Sukses!</strong> Password berhasil diubah.
        </div>
    <?php
    }
    ?>

    <div class="content-body"><!-- Basic form layout section start -->
        <section id="basic-form-layouts">
            <div class="row match-height">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body collapse in">
                            <div class="card-block">
                                <form class="form" action="modules/password/proses.php" method="POST">
                                    <div class="form-body">

                                        <div class="form-group">
                                            <label>Password Lama</label>
                                            <input type="password" class="form-control" name="old_pass" autocomplete="off" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Password Baru</label>
                                            <input type="password" class="form-control" name="new_pass" autocomplete="off" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Ulangi Password Baru</label>
                                            <input type="password" class="form-control" name="retype_pass" autocomplete="off" required>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <input type="submit" class="btn btn-primary btn-simpan mr-1" name="simpan" value="Simpan">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php  
}
?>