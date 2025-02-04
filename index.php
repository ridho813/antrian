<!-- Aplikasi Antrian Pengunjung
 ***************************************
 * Developer    : Vanny Hadiwijaya
 * Company      : Wijaya Studio
 * Release Date : Desember 2019
 * Update       : -
 * Website      : www.vannyhadiwijaya.com
 * E-mail       : vannyhadiwijaya@gmail.com
 * Phone / WA   : 082-132-972-137
 -->
<!DOCTYPE html>
<html lang="en">
	<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<!-- <meta http-equiv="refresh" content="3600" /> -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		
		<title>Sistem Antrian</title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
	    <meta name="description" content="Aplikasi Antrian" />
	    <meta name="author" content="Vanny Hadiwijaya, S.Kom" />

		<meta name="description" content="top menu &amp; navigation" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		 <!-- favicon -->
    	<link rel="shortcut icon" href="pengunjung/assets/img/favicon2.png">

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" type="text/css" href="pengunjung/assets/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="pengunjung/assets/plugins/font-awesome-4.6.3/css/font-awesome.min.css" />

		<!--fonts-->
		<link rel="stylesheet" type="text/css" href="pengunjung/assets/fonts/fonts.googleapis.com.css" />

		<!--ace styles-->
		<link rel="stylesheet" type="text/css" href="pengunjung/assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
		<link rel="stylesheet" type="text/css" href="pengunjung/assets/js/ace-extra.min.js" />

		<!-- custom css -->
		<link rel="stylesheet" type="text/css" href="pengunjung/assets/css/style.css" />
	</head>

	<body style="background-color:transparent;" class="no-skin">
		<div style="background-color:transparent;" class="main-container" id="main-container">
			<div class="main-content">
				<div class="main-content-inner">
					
					<div style="padding:70px 150px 24px" class="page-content">
					  	<div style="margin-top:25px;padding-bottom:1px" class="page-header">
					    	<div class="alert alert-success">
					      		<button type="button" class="close" data-dismiss="alert">
					        		<i class="ace-icon fa fa-times"></i>
					      		</button>
					      		<i style="margin-right:5px" class="ace-icon fa fa-info-circle"></i> Selamat Datang di <b>Sistem Antrian</b>. Silahkan pilih halaman yang ingin ditampilkan.
					    	</div>
					  	</div><!-- /.page-header -->

					  	<div class="row">
					    	<div class="col-xs-12">
					      		<div class="row">

							        <div class="col-lg-4 col-md-4 col-xs-6">
							          	<div class="small-box bg-green">
								            <div class="inner">
								              	<h3 style="font-size:22px"> Nomor Antrian </h3>
								            </div>
								            <div class="icon-set-page">
								              	<i class="fa fa-users"></i>
								            </div>
								            <a href="pengunjung" class="small-box-footer">Pilih <i style="margin-left:5px" class="fa fa-plus-circle"></i></a>
							          	</div>
							        </div>

							        <div class="col-lg-4 col-md-4 col-xs-6">
							          	<div class="small-box bg-green">
								            <div class="inner">
								              	<h3 style="font-size:22px"> Dashboard Antrian </h3>
								            </div>
								            <div class="icon-set-page">
								              	<i class="fa fa-dashboard"></i>
								            </div>
								            <a href="dashboard" class="small-box-footer">Pilih <i style="margin-left:5px" class="fa fa-plus-circle"></i></a>
							          	</div>
							        </div>

							        <div class="col-lg-4 col-md-4 col-xs-6">
							          	<div class="small-box bg-green">
								            <div class="inner">
								              	<h3 style="font-size:22px"> Petugas </h3>
								            </div>
								            <div class="icon-set-page">
								              	<i class="fa fa-user"></i>
								            </div>
							            	<a href="petugas" class="small-box-footer">Pilih <i style="margin-left:5px" class="fa fa-plus-circle"></i></a>
							          	</div>
							        </div>
					      		</div>
					    	</div>
					  	</div><!-- /.row -->
					</div>
				</div>
			</div><!-- /.main-content -->

			<div style="color:#0f0e0f" class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120 pull-left">
							Copyright &copy; 2021 - <a style="color:#0f0e0f" href="https://www.pa-rantau.go.id">Pengadilan Agama Rantau</a>
						</span>
					</div>
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="pengunjung/assets/js/jquery.2.1.1.min.js"></script>
		<!-- <![endif]-->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='pengunjung/assets/js/jquery.min.js'>"+"<"+"/script>");
		</script>
		<!-- <![endif]-->
		
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='pengunjung/assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>

		<script src="pengunjung/assets/js/bootstrap.min.js"></script>

		<!-- ace scripts -->
		<script src="pengunjung/assets/js/ace-elements.min.js"></script>
		<script src="pengunjung/assets/js/ace.min.js"></script>

	</body>
</html>
