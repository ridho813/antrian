<?php  
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' )) {

    // panggil file config.php untuk koneksi ke database
    require_once "../../../config/config.php";

    $hari_ini = gmdate("Y-m-d", time()+60*60*7);
    $loket    = "Loket 3";

    // fungsi query untuk menampilkan data dari tabel antrian
    $result = $mysqli->query("SELECT no_antrian FROM antrian WHERE tanggal='$hari_ini' AND loket='$loket' AND status='1' ORDER BY no_antrian DESC LIMIT 1")
                              or die('Ada kesalahan pada query tampil nomor antrian: '.$mysqli->error);
    $rows = $result->num_rows;
    if ($rows <> 0) {
        $data = $result->fetch_assoc();
        $no_antrian = $data['no_antrian'];  
        echo "$no_antrian";
    } else {
        echo "-";
    } 
} else {
    echo '<script>window.location="../../error-404.html"</script>';
}
?>