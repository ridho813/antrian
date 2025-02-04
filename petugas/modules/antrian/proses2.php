<?php 
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' )) {
    session_start();

    // Panggil koneksi config.php untuk koneksi database
    require_once "../../../config/config.php";

    // ambil data hasil submit dari form
	$hari_ini 	  = gmdate("Y-m-d", time()+60*60*7);
    $no_antrian   = $_POST['no_antrian'];
	$status 	  = "2";
    $updated_user = $_SESSION['antrian_userID'];
    $updated_date = gmdate("Y-m-d H:i:s", time()+60*60*7);

    // perintah query untuk mengubah data last_login pada tabel sys_users
    $update = $mysqli->query("UPDATE antrian 
								SET status         = '$status',
									updated_user   = '$updated_user',
									updated_date   = '$updated_date'
							  WHERE no_antrian     = '$no_antrian'
							    AND tanggal		   = '$hari_ini'")
                       or die('Ada kesalahan pada query update status : '.$mysqli->error);

    // cek query
    if ($update) {
        // jika berhasil tampilkan pesan Sukses
        echo "Sukses";
    }
} else {
    echo '<script>window.location="../../error-404.html"</script>';
}
?>