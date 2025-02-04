 <!-- Aplikasi Antrian Pengunjung
 ***************************************
 * Developer    : Rizani
 * Company      : rizabee_studio
 * Release Date : maret 2021
 * Update       : -
 * Website      : https://pa-rantau.go.id
 * E-mail       : rizabee17@gmail.com
 * Phone / WA   : +62-851-0036-6355
 -->

<?php
// panggil file config.php untuk koneksi ke database
require_once "../config/config.php";

$configID = "1";
// fungsi query untuk menampilkan data dari tabel sys_config
$result = $mysqli->query("SELECT nama_instansi, website, logo FROM sys_config WHERE configID='$configID'")
                          or die('Ada kesalahan pada query tampil data config: '.$mysqli->error);
$data_config   = $result->fetch_assoc();
$nama_instansi = $data_config['nama_instansi'];
$website       = $data_config['website'];
$logo          = $data_config['logo'];
?>

<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="description" content="Aplikasi Antrian Pengunjung <?php echo $nama_instansi; ?>">
        <meta name="keywords" content="Aplikasi Antrian Pengunjung <?php echo $nama_instansi; ?>">
        <meta name="author" content="Indra Vanny Hadiwijaya, S.Kom">

        <title>Login - Aplikasi Antrian <?php echo $nama_instansi; ?></title>

        <link rel="shortcut icon" type="image/png" href="assets/images/favicon2.png">

        <!-- BEGIN VENDOR CSS-->
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
        <!-- font icons-->
        <link rel="stylesheet" type="text/css" href="assets/fonts/icomoon.css">
        <!-- end font icons-->
        <link rel="stylesheet" type="text/css" href="assets/vendors/css/extensions/pace.css">
        <!-- END VENDOR CSS-->
        <!-- BEGIN ROBUST CSS-->
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-extended.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/app.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/colors.min.css">
        <!-- END ROBUST CSS-->
        <!-- BEGIN Custom CSS-->
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
        <!-- END Custom CSS-->
    </head>

    <body data-open="click" data-menu="vertical-menu" data-col="1-column" class="vertical-layout vertical-menu 1-column  blank-page blank-page bg-login">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
        <div class="app-content content container-fluid">
            <div class="content-wrapper">
                <div class="content-body">
                    <section class="flexbox-container">
                        <div class="col-md-4 offset-md-4 col-xs-10 offset-xs-1  box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 m-0">
                                <div class="card-header no-border">
                                    <div class="card-title text-xs-center">
                                        <div class="p-1">
                                            <img src="assets/images/logo-instansi/<?php echo $logo; ?>" alt="logo" width="75"> <br><br>
                                            <h4 style="margin-bottom:0">APLIKASI ANTRIAN</h4>
                                            <h3><?php echo strtoupper($nama_instansi); ?></h3>
                                        </div>
                                    </div>
                                    <h6 class="card-subtitle line-on-side text-muted text-xs-center font-small-3"><span>Silahkan Login</span></h6>
                                </div>
                                <div class="card-body collapse in">
                                    <div class="card-block-login">
                                    <?php  
                                    // fungsi untuk menampilkan pesan
                                    // jika alert = "" (kosong)
                                    // tampilkan pesan "" (kosong)
                                    if (empty($_GET['alert'])) { ?>
                                        <div></div>
                                    <?php
                                    }
                                    // jika alert = 1
                                    // tampilkan pesan Gagal "username atau password salah, cek kembali username dan password Anda"
                                    elseif ($_GET['alert'] == 1) { ?>
                                        <div class="alert alert-danger alert-dismissible fade in mb-2" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <strong><i style="margin-right:7px" class="icon-cancel-circle"></i>Gagal Login!</strong> <br> Username atau Password salah, cek kembali Username dan Password Anda.
                                        </div>
                                    <?php
                                    } 
                                    // jika alert = 2
                                    // tampilkan pesan Sukses "Anda telah berhasil logout"
                                    elseif ($_GET['alert'] == 2) { ?>
                                        <div class="alert alert-success alert-dismissible fade in mb-2" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <strong><i style="margin-right:7px" class="icon-checkmark2"></i>Sukses!</strong> Anda telah berhasil logout.
                                        </div>
                                    <?php
                                    }
                                    // jika alert = 3
                                    // tampilkan pesan Sukses "Anda telah berhasil logout"
                                    elseif ($_GET['alert'] == 3) { ?>
                                        <div class="alert alert-danger alert-dismissible fade in mb-2" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <strong><i style="margin-right:7px" class="icon-notification"></i>Peringatan!</strong> Anda harus login terlebih dahulu.
                                        </div>
                                    <?php
                                    }
                                    ?>

                                        <form class="form-horizontal form-simple" action="login-check.php" method="POST">
                                            <fieldset class="form-group position-relative has-icon-left mb-1">
                                                <input type="text" class="form-control form-control-lg input-lg" name="user_account_name" placeholder="Username" autocomplete="off" required>
                                                <div class="form-control-position">
                                                    <i class="icon-head"></i>
                                                </div>
                                            </fieldset>

                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="password" class="form-control form-control-lg input-lg" name="user_account_password" placeholder="Password" autocomplete="off" required>
                                                <div class="form-control-position">
                                                    <i class="icon-key3"></i>
                                                </div>
                                            </fieldset>
                                            <button type="submit" class="btn btn-app btn-success"><i class="icon-unlock2"></i> Login </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <!-- <center>&copy; 2018 - <a href="http://<?php echo $website; ?>"><?php echo $nama_instansi; ?></a></center> -->
                                    <center>Copyright &copy; 2021 - <a style="color:#0f0e0f" href="https://pa-rantau.go.id">Pengadilan Agama Rantau</a></center>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <!-- ////////////////////////////////////////////////////////////////////////////-->

        <!-- BEGIN VENDOR JS-->
        <script src="assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>
        <script src="assets/js/core/libraries/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/vendors/js/extensions/pace.min.js" type="text/javascript"></script>
        <!-- END VENDOR JS-->
        <!-- BEGIN ROBUST JS-->
        <script src="assets/js/core/app-menu.min.js" type="text/javascript"></script>
        <script src="assets/js/core/app.min.js" type="text/javascript"></script>
        <!-- END ROBUST JS-->
    </body>
</html>
