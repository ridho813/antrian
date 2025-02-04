<div class="page-content center">
	<div class="page-header">
		<div style="margin-top:10px;margin-bottom:5px" class="row">
			<div class="col-xs-12">
			  	<h1 style="color:#0f0e0f;font-size:30px">
					<img src="../petugas/assets/images/logo-instansi/<?php echo $logo; ?>" alt="Logo" height="60">
					<strong id="nama_instansi"><?php echo strtoupper($nama_instansi); ?></strong>
				</h1>
			</div>
		</div>
	</div>

	<div class="alert alert-success">
	  	<i style="margin-right:5px" class="ace-icon fa fa-info-circle"></i> Selamat Datang di <?php echo $nama_instansi; ?>. Silahkan tekan tombol dibawah ini untuk mendapatkan nomor antrian.
	</div>

	<div class="row">
		<div class="col-xs-12">
		  	<div class="row">
			    <div class="col-lg-4 col-md-4 col-xs-12">
					<button id="simpan_antrian_1" class="btn btn-app btn-success">
						<strong>INFORMASI & PENGADUAN<br/>LOKET 1</strong>
						<i style="padding:15px 0;font-size:50px" class="ace-icon fa fa-user-plus"></i> 
						<div id="load_antrian_1"></div>
					</button>

					<button id="simpan_antrian_4" class="btn btn-app btn-success" value="4">
						<strong>PENYERAHAN PRODUK<br/>LOKET 4</strong>
						<i style="padding:15px 0;font-size:50px" class="ace-icon fa fa-user-plus"></i>
						<div id="load_antrian_4"></div>
					</button>
				</div>
				
				<div class="col-lg-4 col-md-4 col-xs-12">
					<button id="simpan_antrian_2" class="btn btn-app btn-success" value="2">
						<strong>PENDAFTARAN PERKARA<br/>LOKET2</strong>
						<i style="padding:15px 0;font-size:50px" class="ace-icon fa fa-user-plus"></i> 
						<div id="load_antrian_2"></div>
					</button>

					<button id="simpan_antrian_5" class="btn btn-app btn-success" value="5">
						<strong>UMUM & SURAT MASUK<br/>LOKET 5</strong>
						<i style="padding:15px 0;font-size:50px" class="ace-icon fa fa-user-plus"></i>
						<div id="load_antrian_5"></div>
					</button>
				</div>
				
			    <div class="col-lg-4 col-md-4 col-xs-12">
					<button id="simpan_antrian_3" class="btn btn-app btn-success" value="3">
						<strong>PEMBAYARAN PERKARA<br/>LOKET 3</strong>
						<i style="padding:15px 0;font-size:50px" class="ace-icon fa fa-user-plus"></i>
						<div id="load_antrian_3"></div>
					</button>

					<button id="simpan_antrian_6" class="btn btn-app btn-success" value="6">
						<strong>E-COURT & GUGATAN MANDIRI<br/>LOKET 6</strong>
						<i style="padding:15px 0;font-size:50px" class="ace-icon fa fa-user-plus"></i>
						<div id="load_antrian_6"></div>
					</button>
				</div>
		  	</div>
		</div>
	</div><!-- /.row -->
</div>

<script type="text/javascript">
$(document).ready(function(){ 	
	var i;
	//$('#load_antrian').load('pages/beranda/getAntrian.php');
	for (i=1; i<=6; i++){
		$('#load_antrian_'+i).load('pages/beranda/getAntrian.php', {'loket':i});
	}
	
	// antrian umum 
	$("#simpan_antrian_1").on('click',function() {
		simpan_antrian(1);
	});
	$("#simpan_antrian_2").on('click',function() {
		simpan_antrian(2);
	});
	$("#simpan_antrian_3").on('click',function() {
		simpan_antrian(3);
	});
	$("#simpan_antrian_4").on('click',function() {
		simpan_antrian(4);
	});
	$("#simpan_antrian_5").on('click',function() {
		simpan_antrian(5);
	});
	$("#simpan_antrian_6").on('click',function() {
		simpan_antrian(6);
	});
}); 

function simpan_antrian(j){
    var nama_instansi = $('#nama_instansi').text();
    var no_loket = j;
    	$.ajax({
		url   : "pages/beranda/proses.php",
		type  : "POST",
		data  : {'loket':j},
		cache : false,
		success: function(msg) { 
			$('#load_antrian_'+j).load('pages/beranda/getAntrian.php', {'loket':j}).fadeIn("slow");
				
			$.get("pages/beranda/print_baru.php", {p1 : nama_instansi, p2: msg, p3 : no_loket});
			
			//setTimeout(printJS("antrian/pengunjung/pages/beranda/"+msg+".pdf"),3000);
			//alert(msg); 
			setTimeout(function() { 
		        printJS("antrian-ptsp/pengunjung/pages/beranda/"+msg+".pdf")	
		    }, 3000);
			
			/*if(msg=="Sukses"){ 
		            $('#load_antrian').load('pages/beranda/getAntrian.php').fadeIn("slow");

		            $.ajax({
	                    url : "pages/beranda/print.php",
	                    type: "POST",
	                    success: function(data, textStatus, jqXHR)
	                    {
	                        // alert('Silahkan ambil nomor antrian Anda')
							$.gritter.add({
								// (string | mandatory) the heading of the notification
								title: 'Terima Kasih..',
								// (string | mandatory) the text inside the notification
								text: 'Silahkan Ambil Nomor Antrian Anda.',
								class_name: 'gritter-warning' + (!$('#simpan_antrian').get(0).checked ? ' gritter-light' : '')
							});
					
							return false;
	                    }
	                });
		        }*/
	    }
	});
}
</script>
