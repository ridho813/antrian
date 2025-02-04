<?php
// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login dan tampilkan pesan = 1
if (empty($_SESSION['antrian_user_account_name']) && empty($_SESSION['antrian_user_account_password'])){
	echo "<meta http-equiv='refresh' content='0; url=login-error'>";
}
// jika user sudah login, maka jalankan perintah untuk pemanggilan file halaman konten
else {
	// jika halaman konten yang dipilih beranda, panggil file view beranda
	if ($_GET['module']=='beranda' && $_SESSION['antrian_user_permissions']=='Administrator') {
		include "modules/beranda/view.php";
	}
	// ---------------------------------------------------------------------------------
	
	// jika halaman konten yang dipilih antrian, panggil file view antrian
	if ($_GET['module']=='antrian') {
		include "modules/antrian/view.php";
	}
	// ---------------------------------------------------------------------------------
	
	// jika halaman konten yang dipilih konfigurasi aplikasi, panggil file view konfigurasi aplikasi
	elseif ($_GET['module']=='config' && $_SESSION['antrian_user_permissions']=='Administrator') {
		include "modules/konfigurasi/view.php";
	}
	// ---------------------------------------------------------------------------------

	// jika halaman konten yang dipilih manajemen user, panggil file view manajemen user
	elseif ($_GET['module']=='user' && $_SESSION['antrian_user_permissions']=='Administrator') {
		include "modules/user/view.php";
	}

	// jika halaman konten yang dipilih form manajemen user, panggil file form manajemen user
	elseif ($_GET['module']=='form_user' && $_SESSION['antrian_user_permissions']=='Administrator') {
		include "modules/user/form.php";
	}
	// ---------------------------------------------------------------------------------

	// jika halaman konten yang dipilih backup database, panggil file view backup database
	elseif ($_GET['module']=='backup' && $_SESSION['antrian_user_permissions']=='Administrator') {
		include "modules/backup-database/view.php";
	}
	// ---------------------------------------------------------------------------------

	// jika halaman konten yang dipilih password, panggil file view password
	elseif ($_GET['module']=='password') {
		include "modules/password/view.php";
	}
	// ---------------------------------------------------------------------------------
}
?>