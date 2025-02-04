    <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
<?php 
// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login dan tampilkan pesan = 1
if (empty($_SESSION['antrian_user_account_name']) && empty($_SESSION['antrian_user_account_password'])){
    echo "<meta http-equiv='refresh' content='0; url=login-error'>";
}
// jika user sudah login, maka jalankan perintah untuk pemanggilan file halaman konten
else {
    // fungsi pengecekan hak akses user untuk menampilkan menu sesuai dengan hak akses
    // jika hak akses = Administrator, tampilkan menu
    if ($_SESSION['antrian_user_permissions']=='Administrator') { ?>
        <li class=" navigation-header">
            <span>Menu Utama</span><i data-toggle="tooltip" data-placement="right" data-original-title="Menu Utama" class="icon-ellipsis icon-ellipsis"></i>
        </li>
        <?php
        // fungsi untuk pengecekan menu aktif
        // jika menu beranda dipilih, menu beranda aktif
        if ($_GET["module"] == "beranda") { ?>
            <li class="active nav-item">
                <a href="beranda"><i class="icon-home3"></i><span class="menu-title">Beranda</span></a>
            </li>
        <?php
        } 
        // jika tidak, menu beranda tidak aktif
        else {  ?>
            <li class=" nav-item">
                <a href="beranda"><i class="icon-home3"></i><span class="menu-title">Beranda</span></a>
            </li>
        <?php
        }
        ?>

        <li class=" navigation-header">
            <span>Utility</span><i data-toggle="tooltip" data-placement="right" data-original-title="Utility" class="icon-ellipsis icon-ellipsis"></i>
        </li>

        <?php
        // jika menu konfigurasi aplikasi dipilih, menu konfigurasi aplikasi aktif
        if ($_GET["module"] == "config") { ?>
            <li class="active nav-item">
                <a href="konfigurasi-aplikasi"><i class="icon-cog"></i><span class="menu-title">Konfigurasi Aplikasi</span></a>
            </li>
        <?php
        } 
        // jika tidak, menu konfigurasi aplikasi tidak aktif
        else {  ?>
            <li class=" nav-item">
                <a href="konfigurasi-aplikasi"><i class="icon-cog"></i><span class="menu-title">Konfigurasi Aplikasi</span></a>
            </li>
        <?php
        }

        // jika menu user dipilih, menu user aktif
        if ($_GET["module"] == "user" || $_GET["module"] == "form_user") { ?>
            <li class="active nav-item">
                <a href="user"><i class="icon-user"></i><span class="menu-title">Manajemen User</span></a>
            </li>
        <?php
        } 
        // jika tidak, menu user tidak aktif
        else {  ?>
            <li class=" nav-item">
                <a href="user"><i class="icon-user"></i><span class="menu-title">Manajemen User</span></a>
            </li>
        <?php
        }

        // jika menu Backup Database dipilih, menu Backup Database aktif
        if ($_GET["module"] == "backup") { ?>
            <li class="active nav-item">
                <a href="backup-database"><i class="icon-database"></i><span class="menu-title">Backup Database</span></a>
            </li>
        <?php
        } 
        // jika tidak, menu Backup Database tidak aktif
        else {  ?>
            <li class=" nav-item">
                <a href="backup-database"><i class="icon-database"></i><span class="menu-title">Backup Database</span></a>
            </li>
        <?php
        }
    }
    // jika hak akses = Loket, tampilkan menu ------------------------------------------------------------------------------------------------------
    else {  ?>
        <li class=" navigation-header">
            <span>Menu Utama</span><i data-toggle="tooltip" data-placement="right" data-original-title="Menu Utama" class="icon-ellipsis icon-ellipsis"></i>
        </li>
        <?php
        // fungsi untuk pengecekan menu aktif
        // jika menu antrian dipilih, menu antrian aktif
        if ($_GET["module"] == "antrian") { ?>
            <li class="active nav-item">
                <a href="antrian"><i class="icon-users2"></i><span class="menu-title">Antrian</span></a>
            </li>
        <?php
        } 
        // jika tidak, menu antrian tidak aktif
        else {  ?>
            <li class=" nav-item">
                <a href="antrian"><i class="icon-users2"></i><span class="menu-title">Antrian</span></a>
            </li>
        <?php
        }
    }  
}
?>
    </ul>