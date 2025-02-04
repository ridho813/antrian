<?php  
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' )) {
    session_start();
    // panggil file config.php untuk koneksi ke database
    require_once "../../../config/config.php";

    $hari_ini = gmdate("Y-m-d", time()+60*60*7);

    // fungsi query untuk menampilkan data dari tabel antrian
    $result = $mysqli->query("SELECT no_antrian FROM antrian WHERE tanggal='$hari_ini' AND status='0' ORDER BY no_antrian ASC LIMIT 1")
                              or die('Ada kesalahan pada query tampil nomor antrian: '.$mysqli->error);
    $rows = $result->num_rows;
    if ($rows <> 0) {
        $data = $result->fetch_assoc();
        $no_antrian = $data['no_antrian'];  
        echo "<h3 class='cyan'>$no_antrian</h3>";
    } else {
        echo "<h3 class='cyan'>-</h3>";
    }
} else {
    echo '<script>window.location="../../error-404.html"</script>';
}
?>