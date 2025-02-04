<?php  
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' )) {
    session_start();
    // panggil file config.php untuk koneksi ke database
    require_once "../../../config/config.php";

    $hari_ini = gmdate("Y-m-d", time()+60*60*7);
    $loket    = "Loket 1";

    // fungsi query untuk menampilkan data dari tabel antrian
    $result_nomor = $mysqli->query("SELECT no_antrian 
									FROM antrian 
									WHERE tanggal='$hari_ini' 
									AND loket='$loket' 
									AND status IN ('1','2')
									ORDER BY no_antrian DESC 
									LIMIT 1")
                             or die('Ada kesalahan pada query tampil nomor antrian: '.$mysqli->error);
    $rows_nomor = $result_nomor->num_rows;
    if ($rows_nomor <> 0) {
        $data_nomor = $result_nomor->fetch_assoc();
        $no_antrian = $data_nomor['no_antrian'];  
    } else {
        $no_antrian = "-";
    } 

    // fungsi query untuk menampilkan data dari tabel antrian
    $result_jumlah = $mysqli->query("SELECT COUNT(ID) as jumlah 
									FROM antrian 
									WHERE tanggal='$hari_ini' 
									AND loket='$loket' 
									AND status='1'")
                              or die('Ada kesalahan pada query tampil jumlah antrian: '.$mysqli->error);
    $data_jumlah = $result_jumlah->fetch_assoc();
    $jumlah_antrian = $data_jumlah['jumlah'];
?>
		
	<div class="p-2 text-xs-center bg-primary media-left media-middle">
		<h1 id="loket1_tiket" style="color:#fff"><?php echo $no_antrian; ?></h1>
	</div>
	<div class="p-2 media-body">
		<h5 class="primary">LOKET 1</h5>
		<h5 class="text-bold-400"><?php echo number_format($jumlah_antrian); ?></h5>
		<progress class="progress progress-sm progress-primary mt-1 mb-0" value="<?php echo $jumlah_antrian; ?>" max="100"></progress>
	</div>

<?php  
} else {
    echo '<script>window.location="../../error-404.html"</script>';
}
?>

