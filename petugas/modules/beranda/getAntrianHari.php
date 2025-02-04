<?php  
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' )) { ?>
    <ul class="list-group list-group-flush">
        <?php  
        // panggil file config.php untuk koneksi ke database
        require_once "../../../config/config.php";

        $hari_ini = gmdate("Y-m-d", time()+60*60*7);
        $loket    = "Loket 1";
        // fungsi query untuk menampilkan data dari tabel antrian
        $result = $mysqli->query("SELECT count(ID) as jumlah FROM antrian WHERE tanggal='$hari_ini' AND loket='$loket'")
                                  or die('Ada kesalahan pada query tampil data antrian loket 1: '.$mysqli->error);
        $data = $result->fetch_assoc();
        $antrian_loket1 = $data['jumlah'];
        ?>
        <li style="padding:.75rem 3rem;" class="list-group-item">
            <span class="tag tag-default tag-pill bg-primary float-xs-right"><?php echo number_format($antrian_loket1); ?></span><i style="margin-right:5px" class="icon-point-right"></i> Loket 1
        </li>

        <?php  
        $loket = "Loket 2";
        // fungsi query untuk menampilkan data dari tabel antrian
        $result = $mysqli->query("SELECT count(ID) as jumlah FROM antrian WHERE tanggal='$hari_ini' AND loket='$loket'")
                                  or die('Ada kesalahan pada query tampil data antrian loket 2: '.$mysqli->error);
        $data = $result->fetch_assoc();
        $antrian_loket2 = $data['jumlah'];
        ?>
        <li style="padding:.75rem 3rem;" class="list-group-item">
            <span class="tag tag-default tag-pill bg-info float-xs-right"><?php echo number_format($antrian_loket2); ?></span><i style="margin-right:5px" class="icon-point-right"></i> Loket 2
        </li>

        <?php  
        $loket = "Loket 3";
        // fungsi query untuk menampilkan data dari tabel antrian
        $result = $mysqli->query("SELECT count(ID) as jumlah FROM antrian WHERE tanggal='$hari_ini' AND loket='$loket'")
                                  or die('Ada kesalahan pada query tampil data antrian loket 3: '.$mysqli->error);
        $data = $result->fetch_assoc();
        $antrian_loket3 = $data['jumlah'];
        ?>
        <li style="padding:.75rem 3rem;" class="list-group-item">
            <span class="tag tag-default tag-pill bg-warning float-xs-right"><?php echo number_format($antrian_loket3); ?></span><i style="margin-right:5px" class="icon-point-right"></i> Loket 3
        </li>

        <?php  
        $loket = "Loket 4";
        // fungsi query untuk menampilkan data dari tabel antrian
        $result = $mysqli->query("SELECT count(ID) as jumlah FROM antrian WHERE tanggal='$hari_ini' AND loket='$loket'")
                                  or die('Ada kesalahan pada query tampil data antrian loket 4: '.$mysqli->error);
        $data = $result->fetch_assoc();
        $antrian_loket4 = $data['jumlah'];
        ?>
		<li style="padding:.75rem 3rem;" class="list-group-item">
            <span class="tag tag-default tag-pill bg-success float-xs-right"><?php echo number_format($antrian_loket4); ?></span><i style="margin-right:5px" class="icon-point-right"></i> Loket 4
        </li>
		
		<?php  
        $loket = "Loket 5";
        // fungsi query untuk menampilkan data dari tabel antrian
        $result = $mysqli->query("SELECT count(ID) as jumlah FROM antrian WHERE tanggal='$hari_ini' AND loket='$loket'")
                                  or die('Ada kesalahan pada query tampil data antrian loket 5: '.$mysqli->error);
        $data = $result->fetch_assoc();
        $antrian_loket5 = $data['jumlah'];
        ?>
		<li style="padding:.75rem 3rem;" class="list-group-item">
            <span class="tag tag-default tag-pill bg-danger float-xs-right"><?php echo number_format($antrian_loket5); ?></span><i style="margin-right:5px" class="icon-point-right"></i> Loket 5
        </li>
				
		<?php  
        $loket = "Loket 6";
        // fungsi query untuk menampilkan data dari tabel antrian
        $result = $mysqli->query("SELECT count(ID) as jumlah FROM antrian WHERE tanggal='$hari_ini' AND loket='$loket'")
                                  or die('Ada kesalahan pada query tampil data antrian loket 6: '.$mysqli->error);
        $data = $result->fetch_assoc();
        $antrian_loket6 = $data['jumlah'];
        ?>
		<li style="padding:.75rem 3rem;" class="list-group-item">
            <span class="tag tag-default tag-pill bg-dark float-xs-right"><?php echo number_format($antrian_loket6); ?></span><i style="margin-right:5px" class="icon-point-right"></i> Loket 6
        </li>        
    </ul>
<?php  
} else {
    echo '<script>window.location="../../error-404.html"</script>';
}
?>