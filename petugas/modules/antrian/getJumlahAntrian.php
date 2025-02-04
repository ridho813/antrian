<?php  
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' )) {
    session_start();
    // panggil file config.php untuk koneksi ke database
    require_once "../../../config/config.php";

    $hari_ini = gmdate("Y-m-d", time()+60*60*7);

    // fungsi query untuk menampilkan data dari tabel antrian
    $result = $mysqli->query("SELECT count(ID) as jumlah FROM antrian WHERE tanggal='$hari_ini'")
                              or die('Ada kesalahan pada query tampil jumlah antrian: '.$mysqli->error);
    $data = $result->fetch_assoc();
    $jumlah_antrian = $data['jumlah'];
?>
    <h3 class="deep-orange"><?php echo number_format($jumlah_antrian); ?></h3>
<?php  
} else {
    echo '<script>window.location="../../error-404.html"</script>';
}
?>