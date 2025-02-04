 

<?php  
// panggil file config.php untuk koneksi ke database
require_once "../config/config.php";
// panggil file fungsi nama hari
require_once "../config/fungsi_nama_hari.php";
// panggil file fungsitanggal indonesia
require_once "../config/fungsi_tanggal.php";

$configID = "1";
// fungsi query untuk menampilkan data dari tabel sys_config
$result = $mysqli->query("SELECT nama_instansi, alamat, telepon, email, website, logo FROM sys_config WHERE configID='$configID'")
                          or die('Ada kesalahan pada query tampil data config: '.$mysqli->error);
$data_config   = $result->fetch_assoc();
$nama_instansi = $data_config['nama_instansi'];
$alamat        = $data_config['alamat'];
$telepon       = $data_config['telepon'];
$email         = $data_config['email'];
$website       = $data_config['website'];
$logo          = $data_config['logo'];
?>

<!DOCTYPE html>
<html lang="en">
	<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<!-- <meta http-equiv="refresh" content="3600" /> -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		
		<title>Antrian Pengunjung <?php echo $nama_instansi; ?></title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
	    <meta name="description" content="Aplikasi Antrian Pengunjung" />
	    <meta name="author" content="Vanny Hadiwijaya, S.Kom" />

		<meta name="description" content="top menu &amp; navigation" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		 <!-- favicon -->
    	<link rel="shortcut icon" href="assets/img/favicon2.png">

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="assets/plugins/font-awesome-4.6.3/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="assets/css/jquery.gritter.min.css" />

		<!--fonts-->
		<link rel="stylesheet" type="text/css" href="assets/fonts/fonts.googleapis.com.css" />

		<!--ace styles-->
		<link rel="stylesheet" type="text/css" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
		<link rel="stylesheet" type="text/css" href="assets/js/ace-extra.min.js" />

		<!-- custom css -->
		<link rel="stylesheet" type="text/css" href="assets/css/style.css" />

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="assets/js/jquery.2.1.1.min.js"></script>
		<!-- <![endif]-->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='assets/js/jquery.min.js'>"+"<"+"/script>");
		</script>
		<!-- <![endif]-->
		
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
	</head>

	<body class="no-skin">
		<div id="navbar" class="navbar navbar-default navbar-collapse h-navbar navbar-fixed-top">
			<div class="navbar-container" id="navbar-container">
				<div class="navbar-header pull-left">
					<a style="margin-right:-7px" href="#" class="navbar-brand pull-left">
						<img src="../petugas/assets/images/logo-instansi/<?php echo $logo; ?>" alt="Logo" height="80">
					</a>
					<a style="margin-top:8px; color:#0f0e0f" href="#" class="navbar-brand">
						<span><?php echo strtoupper($nama_instansi); ?></span> <br>
						<span style="font-size:14px"><?php echo $alamat; ?></span> <br>
						<span style="font-size:14px">Telp. <?php echo $telepon; ?></span>
					</a>
				</div>

				<div class="navbar-header pull-right">
					<a style="margin-top:10px; color:#0f0e0f" href="#" class="navbar-brand">
						<span style="font-size:42px;" id="clockDisplay"><?php echo tgl_eng_to_ind(date("d-m-Y")); ?></span> <br><br>
                      	<script type="text/javascript" language="javascript">
						function renderTime(){
						 	var currentTime = new Date();
						 	var h = currentTime.getHours();
						 	var m = currentTime.getMinutes();
						 	var s = currentTime.getSeconds();

						 	if (h == 0) {
						  		h = 24;
						   	}
						   	if (h < 10){
						    	h = "0" + h;
						    }
						    if (m < 10){
						    	m = "0" + m;
						    }
						    if (s < 10){
						    	s = "0" + s;
						    }

						 	var myClock = document.getElementById('clockDisplay');
						 	myClock.textContent = h + ":" + m + ":" + s + "";    
						 	setTimeout ('renderTime()',1000);
						}
						renderTime();
						</script>

						<span style="font-size:20px"><?php echo nama_hari(date("Y-m-d")); ?>, <?php echo tgl_eng_to_ind(date("d-m-Y")); ?></span>
					</a>
				</div>
			</div><!-- /.navbar-container -->
		</div>

		<div class="main-container" id="main-container">
			<div class="main-content">
				<div class="main-content-inner">
					
					<!-- panggil file "content.php" untuk menampilkan halaman konten-->
              		<?php include "content.php"; ?>
              		
				</div>
			</div><!-- /.main-content -->

			<div style="color:#0f0e0f" class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120 pull-left">
							<!-- &copy; 2018 - <a style="color:#E5E5E5" href="http://<?php echo $website; ?>"><?php echo $nama_instansi; ?></a> -->
							Copyright &copy; 2021 - <a style="color:#0f0e0f" href="https://www.pa-pelaihari.go.id">Pengadilan Agama Pelaihari</a>
						</span>
					</div>
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- scripts -->
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/jquery.gritter.min.js"></script>
		<!-- ace scripts -->
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>

	</body>
</html>

