<?php  
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' )) {

    // panggil file config.php untuk koneksi ke database
    require_once "../../../config/config.php";

    $hari_ini = gmdate("Y-m-d", time()+60*60*7);
	$loket = $_POST['loket'];

    // fungsi query untuk menampilkan data dari tabel antrian
    $result = $mysqli->query("SELECT count(ID) as jumlah 
							  FROM antrian 
							  WHERE tanggal='$hari_ini' 
							  AND RIGHT(loket,1)='$loket'")
                              or die('Ada kesalahan pada query tampil jumlah antrian: '.$mysqli->error);
    $data = $result->fetch_assoc();
    $jumlah_antrian = $data['jumlah'];
?>
    Antrian : <?php echo number_format($jumlah_antrian); ?>
<?php  
} else {
    echo '<script>window.location="../../error-404.html"</script>';
}
?>