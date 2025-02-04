<?php  
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' )) {
    session_start();
    // panggil file config.php untuk koneksi ke database
    require_once "../../../config/config.php";

    $hari_ini = gmdate("Y-m-d", time()+60*60*7);

    // fungsi query untuk menampilkan data dari tabel antrian
    $result = $mysqli->query("SELECT count(ID) as jumlah FROM antrian WHERE tanggal='$hari_ini' AND status='0'")
                              or die('Ada kesalahan pada query tampil sisa antrian: '.$mysqli->error);
    $data = $result->fetch_assoc();
    $sisa_antrian = $data['jumlah'];
?>
    <h3 class="pink"><?php echo number_format($sisa_antrian); ?></h3>
<?php  
} else {
    echo '<script>window.location="../../error-404.html"</script>';
}
?>