<?php  
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' )) {
    // Panggil koneksi config.php untuk koneksi database
    require_once "../../../config/config.php";

    // fungsi untuk membuat ID antrian
    $result = $mysqli->query("SELECT max(ID) as kode FROM antrian")
                              or die('Ada kesalahan pada query tampil data id antrian: '.$mysqli->error);
    $data = $result->fetch_assoc();

    $ID      = $data['kode'] + 1;
    $tanggal = gmdate("Y-m-d", time()+60*60*7);
    $tgl     = gmdate("Y-m-d");
	
    // fungsi untuk membuat no antrian
    $result = $mysqli->query("SELECT RIGHT(no_antrian,2) AS kode FROM antrian WHERE tanggal='$tanggal' ORDER BY ID DESC LIMIT 1")
                              or die('Ada kesalahan pada query tampil data id antrian: '.$mysqli->error);
    $rows = $result->num_rows;

    if ($rows <> 0) {
        $data = $result->fetch_assoc();
        $kode = $data['kode']+1;
    } else {
        $kode = '001';
    }

    $buat_antrian = str_pad($kode, 3, "0", STR_PAD_LEFT);
    $no_antrian   = $buat_antrian;
	$loket		  = "Loket ".$_POST['loket'];
    $exp1         = substr($no_antrian,0,1);
    $exp2         = substr($no_antrian,1,1);
    $exp3         = substr($no_antrian,2,1);
    $panggil      = $exp1." ".$exp2." ".$exp3;

    // perintah query untuk menyimpan data ke tabel antrian
    $insert = $mysqli->query("INSERT INTO antrian(ID,tanggal,loket,no_antrian,panggil)
                              VALUES('$ID','$tanggal','$loket','$no_antrian','$panggil')")
                             or die('Ada kesalahan pada query insert : '.$mysqli->error);
    // cek query
    if ($insert) {
        // jika berhasil tampilkan pesan Sukses
        echo $no_antrian."-".$tgl;
    }
} else {
    echo '<script>window.location="../../error-404.html"</script>';
}
?>