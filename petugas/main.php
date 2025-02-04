<?php
ob_start();
?>
 <!-- Aplikasi Antrian Pengunjung
 ***************************************
 * Developer    : Vanny Hadiwijaya, S.Kom
 * Company      : Wijaya Studio
 * Release Date : November 2018
 * Update       : -
 * Website      : https://vannyhadiwijaya.blogspot.com
 * E-mail       : vannyhadiwijaya@gmail.com
 * Phone / WA   : +62-821-3297-2137
 -->
<?php
session_start();      // memulai session

// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login dan tampilkan pesan = 1
if (empty($_SESSION['antrian_user_account_name']) && empty($_SESSION['antrian_user_account_password'])){
    echo "<meta http-equiv='refresh' content='0; url=login-error'>";
}
// jika user sudah login, maka jalankan perintah untuk pemanggilan file halaman konten
else {
    // panggil file config.php untuk koneksi ke database
    require_once "../config/config.php";

    $configID = "1";
    // fungsi query untuk menampilkan data dari tabel sys_config
    $result = $mysqli->query("SELECT nama_instansi, alamat, telepon, email, website, logo FROM sys_config WHERE configID='$configID'")
                              or die('Ada kesalahan pada query tampil data config: '.$mysqli->error);
    $data_config   = $result->fetch_assoc();
    $nama_instansi = $data_config['nama_instansi'];
    $alamat        = $data_config['alamat'];
    $telepon       = $data_config['telepon'];
    $email         = $data_config['email'];
    $website       = $data_config['website'];
    $logo          = $data_config['logo'];
    ?>

    <!DOCTYPE html>
    <html lang="en" data-textdirection="ltr" class="loading">
        <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
            <meta name="description" content="Aplikasi Antrian Nasabah <?php echo $nama_instansi; ?>">
            <meta name="keywords" content="Aplikasi Antrian Pengunjung <?php echo $nama_instansi; ?>">
            <meta name="author" content="Vanny Hadiwijaya, S.Kom">

            <?php  
            // fungsi untuk menampilkan title sesuai dengan halaman yang dibuka
            // jika halaman Beranda dipilih, tampilkan title Beranda 
            if ($_GET['module']=='beranda') {
                echo "<title>Beranda - Aplikasi Antrian Pengunjung $nama_instansi</title>";
            } 
            // jika halaman antrian dipilih, tampilkan title antrian 
            elseif ($_GET['module']=='antrian') {
                echo "<title>Antrian - Aplikasi Antrian Pengunjung $nama_instansi</title>";
            } 
            // jika halaman Konfigurasi Aplikasi dipilih, tampilkan title Konfigurasi Aplikasi 
            elseif ($_GET['module']=='config') {
                echo "<title>Konfigurasi Aplikasi - Aplikasi Antrian Pengunjung $nama_instansi</title>";
            }
            // jika halaman Manajemen User dipilih, tampilkan title Manajemen User 
            elseif ($_GET['module']=='user' || $_GET['module']=='form_user') {
                echo "<title>Manajemen User - Aplikasi Antrian Pengunjung $nama_instansi</title>";
            } 
            // jika halaman Backup Database dipilih, tampilkan title Backup Database 
            elseif ($_GET['module']=='backup') {
                echo "<title>Backup Database - Aplikasi Antrian Pengunjung $nama_instansi</title>";
            } 
            // jika halaman Password dipilih, tampilkan title Password 
            elseif ($_GET['module']=='password') {
                echo "<title>Password - Aplikasi Antrian Pengunjung $nama_instansi</title>";
            }
            ?>
            <!-- Favicon-->
            <link rel="shortcut icon" type="image/png" href="assets/images/favicon2.png">
            <!-- BEGIN VENDOR CSS-->
            <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
            <!-- font icons-->
            <link rel="stylesheet" type="text/css" href="assets/fonts/icomoon.css">
            <link rel="stylesheet" type="text/css" href="assets/vendors/css/extensions/pace.css">
            <link rel="stylesheet" type="text/css" href="assets/vendors/css/datatables/dataTables.bootstrap.css">
            <link rel="stylesheet" type="text/css" href="assets/vendors/css/datepicker/datepicker.min.css">
            <link rel="stylesheet" type="text/css" href="assets/vendors/css/chosen/chosen.min.css">
            <!-- END VENDOR CSS-->
            <!-- BEGIN ROBUST CSS-->
            <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-extended.min.css">
            <link rel="stylesheet" type="text/css" href="assets/css/app.min.css">
            <link rel="stylesheet" type="text/css" href="assets/css/colors.min.css">
            <!-- END ROBUST CSS-->
            <!-- BEGIN Page Level CSS-->
            <link rel="stylesheet" type="text/css" href="assets/css/core/menu/menu-types/vertical-menu.min.css">
            <link rel="stylesheet" type="text/css" href="assets/css/core/menu/menu-types/vertical-overlay-menu.min.css">
            <!-- END Page Level CSS-->
            <!-- BEGIN Custom CSS-->
            <link rel="stylesheet" type="text/css" href="assets/css/style.css">
            <!-- END Custom CSS-->

            <script src="assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>
            <!-- responsivevoice -->
            <script src="https://responsivevoice.org/responsivevoice/responsivevoice.js"></script>

            <!-- Fungsi untuk membatasi karakter yang diinputkan -->
            <script language="javascript">
            function getkey(e)
            {
                if (window.event)
                    return window.event.keyCode;
                else if (e)
                    return e.which;
                else
                    return null;
            }

            function goodchars(e, goods, field)
            {
                var key, keychar;
                key = getkey(e);
                if (key == null) return true;
               
                keychar = String.fromCharCode(key);
                keychar = keychar.toLowerCase();
                goods = goods.toLowerCase();
               
                // check goodkeys
                if (goods.indexOf(keychar) != -1)
                    return true;
                // control keys
                if ( key==null || key==0 || key==8 || key==9 || key==27 )
                    return true;
                  
                if (key == 13) {
                    var i;
                    for (i = 0; i < field.form.elements.length; i++)
                        if (field == field.form.elements[i])
                            break;
                    i = (i + 1) % field.form.elements.length;
                    field.form.elements[i].focus();
                    return false;
                    };
                // else return false
                return false;
            }
            </script>
        </head>
        <body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">
            <!-- navbar-fixed-top-->
            <nav class="header-navbar navbar navbar-with-menu navbar-fixed-top navbar-semi-dark navbar-shadow">
                <div class="navbar-wrapper">
                    <div class="navbar-header">
                        <ul class="nav navbar-nav">
                            <li class="nav-item mobile-menu hidden-md-up float-xs-left">
                                <a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5 font-large-1"></i></a>
                            </li>
                            <li class="nav-item">
                            <?php 
                            if ($_SESSION['antrian_user_permissions']=='Administrator') { ?>
                                <a href="beranda" class="navbar-brand nav-link"><img alt="branding logo" src="assets/images/logo/logo-light.png" data-expand="assets/images/logo/logo-light.png" data-collapse="assets/images/logo/logo-sm.png" class="brand-logo"></a>
                            <?php
                            } else { ?>
                                <a href="antrian" class="navbar-brand nav-link"><img alt="branding logo" src="assets/images/logo/logo-light.png" data-expand="assets/images/logo/logo-light.png" data-collapse="assets/images/logo/logo-sm.png" class="brand-logo"></a>
                            <?php
                            }
                            ?>
                            </li>
                            <li class="nav-item hidden-md-up float-xs-right">
                                <a data-toggle="collapse" data-target="#navbar-mobile" class="nav-link open-navbar-container"><i class="icon-ellipsis pe-2x icon-icon-rotate-right-right"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="navbar-container content container-fluid">
                        <div id="navbar-mobile" class="collapse navbar-toggleable-sm">
                            <ul class="nav navbar-nav">
                                <li class="nav-item hidden-sm-down"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5"></i></a></li>
                                <li class="nav-item hidden-sm-down"><a href="#" class="nav-link nav-link-expand"><i class="ficon icon-expand2"></i></a></li>
                            </ul>
                            <ul class="nav navbar-nav float-xs-right">
                                <li class="dropdown dropdown-user nav-item">
                                    <a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link dropdown-user-link">
                                        <span class="avatar"><img src="assets/images/avatar/avatar-purple.png" alt="avatar"></span>
                                        <!-- Tampilkan Nama User sesuai dengan Session User yang login -->
                                        <span class="user-name"><?php echo $_SESSION['antrian_fullname']; ?></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="password" class="dropdown-item"><i class="icon-lock"></i> Ubah Password</a>
                                        <div class="dropdown-divider"></div>
                                        <a data-toggle="modal" href="#logout" class="dropdown-item"><i class="icon-power3"></i> Logout</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- ////////////////////////////////////////////////////////////////////////////-->

            <!-- main menu-->
            <div data-scroll-to-active="true" class="main-menu menu-fixed menu-dark menu-accordion menu-shadow">
                <!-- main menu content-->
                <div class="main-menu-content">

                    <!-- panggil file "sidebar-menu.php" untuk menampilkan menu -->
                    <?php include "sidebar-menu.php"; ?>

                </div>
                <!-- /main menu content-->
            </div>
            <!-- / main menu-->

            <div style="min-height:94%" class="app-content content container-fluid">
                <div class="content-wrapper">
                    
                    <!-- panggil file "content.php" untuk menampilkan halaman konten-->
                    <?php include "content.php"; ?>
                    
                    <!-- Modal Logout -->
                    <div class="modal fade text-xs-left" id="logout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel1"><i style="margin-right:7px" class="icon-power3"></i> Logout </h4>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah Anda yakin ingin logout?</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="logout.php" class="btn btn-danger mr-1">Ya, Logout</a>
                                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Batal</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ////////////////////////////////////////////////////////////////////////////-->

            <footer class="footer footer-static footer-light navbar-border">
                <p class="clearfix text-muted text-sm-center mb-0 px-2">
                    <!-- <span class="float-md-left d-xs-block d-md-inline-block">Copyright  &copy; 2018 - <a href="http://<?php echo $website; ?>" target="_blank" class="text-bold-500 grey darken-2"><?php echo $nama_instansi; ?></a></span> -->
                    <span class="float-md-left d-xs-block d-md-inline-block">Copyright Riza Muhammad; 2021 - <a href="https://pa-rantau.com" target="_blank" class="text-bold-500 grey darken-2">Pengadilan Agama Rantau</a></span>
                </p>
            </footer>

            <!-- BEGIN VENDOR JS-->
            <!-- <script src="assets/js/core/libraries/jquery.min.js" type="text/javascript"></script>-->
            <script src="assets/vendors/js/ui/tether.min.js" type="text/javascript"></script>
            <script src="assets/js/core/libraries/bootstrap.min.js" type="text/javascript"></script>
            <script src="assets/vendors/js/ui/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
            <script src="assets/vendors/js/ui/unison.min.js" type="text/javascript"></script>
            <script src="assets/vendors/js/ui/blockUI.min.js" type="text/javascript"></script>
            <script src="assets/vendors/js/ui/jquery.matchHeight-min.js" type="text/javascript"></script>
            <script src="assets/vendors/js/ui/screenfull.min.js" type="text/javascript"></script>
            <script src="assets/vendors/js/extensions/pace.min.js" type="text/javascript"></script>
            <script src="assets/vendors/js/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
            <script src="assets/vendors/js/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
            <script src="assets/vendors/js/datepicker/bootstrap-datepicker.min.js" type="text/javascript"></script>
            <script src="assets/vendors/js/chosen/chosen.jquery.min.js" type="text/javascript"></script>
            <!-- BEGIN VENDOR JS-->
            <!-- BEGIN ROBUST JS-->
            <script src="assets/js/core/app-menu.min.js" type="text/javascript"></script>
            <script src="assets/js/core/app.min.js" type="text/javascript"></script>
            <!-- END ROBUST JS-->

            <script type="text/javascript">
            $(document).ready(function() {
                // datepicker plugin
                $('.date-picker').datepicker({
                    autoclose: true,
                    todayHighlight: true
                });

                // chosen select
                $("#chosen-select").chosen();
            } );
            </script>
        </body>
    </html>
<?php  
}
?>
