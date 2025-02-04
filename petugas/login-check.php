<?php
// panggil file config.php untuk koneksi ke database
require_once "../config/config.php";

// ambil data hasil submit dari form
$user_account_name     = mysqli_real_escape_string($mysqli, stripslashes(strip_tags(htmlspecialchars(trim($_POST['user_account_name'])))));
$user_account_password = sha1(md5(mysqli_real_escape_string($mysqli, stripslashes(strip_tags(htmlspecialchars(trim($_POST['user_account_password'])))))));

// pastikan username dan password adalah berupa huruf atau angka.
if (!ctype_alnum($user_account_name) OR !ctype_alnum($user_account_password)) {
	// jika username dan password adalah berupa selain huruf atau angka, alihkan ke halaman login dan tampilkan pesan = 1
	header("Location: login-failed");
} 
// jika username dan password adalah berupa huruf atau angka.
else {
	// ambil data dari tabel sys_users untuk pengecekan berdasarkan inputan username dan passrword
	$result = $mysqli->query("SELECT userID,fullname,user_account_name,user_account_password,user_permissions,block_users FROM sys_users 
							  WHERE user_account_name='$user_account_name' AND user_account_password='$user_account_password' AND block_users='Tidak'")
							  or die('Ada kesalahan pada query user : '.$mysqli->error);
	$rows = $result->num_rows;

	// jika data ada, jalankan perintah untuk membuat session
	if ($rows > 0) {
		$data = $result->fetch_assoc();
		session_start();
		$_SESSION['antrian_userID']                = $data['userID'];
		$_SESSION['antrian_user_account_name']     = $data['user_account_name'];
		$_SESSION['antrian_user_account_password'] = $data['user_account_password'];
		$_SESSION['antrian_fullname']              = $data['fullname'];
		$_SESSION['antrian_user_permissions']      = $data['user_permissions'];

		$today = gmdate("Y-m-d H:i:s", time()+60*60*7);
		// perintah query untuk mengubah data last_login pada tabel sys_users
		$update = $mysqli->query("UPDATE sys_users SET last_login 	= '$today',
													   updated_user = '$data[userID]',
													   updated_date = '$today'
								  				 WHERE userID 		= '$data[userID]'")
								  or die('Ada kesalahan pada query last login : '.$mysqli->error);	

		// cek query
		if ($update) {
			// jika berhasil, lakukan pengecekan user_permissions
			if ($data['user_permissions']=='Administrator') {
				// jika admin, lalu alihkan ke halaman admin -> beranda
				header("Location: beranda");
			} else {
				// jika selain admin, lalu alihkan ke halaman admin -> antrian
				header("Location: antrian");
			}
		}
	}
	// jika data tidak ada, alihkan ke halaman login dan tampilkan pesan = 1
	else {
		header("Location: login-failed");
	}
}
?>