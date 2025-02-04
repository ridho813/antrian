<div class="page-content">
	<div style="margin-top:55px;" class="row">
		<div class="col-xs-12">
		  	<div class="row center">
			    <div id="load_antrian" class="col-lg-6 col-md-6 col-xs-6"></div>

			    <div id="muteYouTubeVideoPlayer" class="col-lg-6 col-md-6 col-xs-6">
			      	<iframe width="100%" height="326" src="https://www.youtube.com/watch?v=cpiexoTuY80" frameborder="0" allowfullscreen></iframe>
			    </div>
		  	</div>
		</div>
	</div><!-- /.row -->
	
	<hr>

	<div class="row">
		<div class="col-xs-12">
		  	<div class="row center">
			    <div class="col-lg-2 col-md-2 col-xs-12">
			      	<button class="btn btn-app btn-pink">
				        <div>Informasi &<br/>Pengaduan</div>
		        		<div style="font-size:25px;margin-top:-10px" id="load_loket1"></div>
				        <div style="border-bottom:1px solid #fff"></div>
		        		<div>Loket 1</div>
			      	</button>
			    </div>

			    <div class="col-lg-2 col-md-2 col-xs-12">
			      	<button class="btn btn-app btn-warning">
				        <div>Pendaftaran<br/>Perkara</div>
		        		<div style="font-size:25px;margin-top:-10px" id="load_loket2"></div>
				        <div style="border-bottom:1px solid #fff"></div>
		        		<div>Loket 2</div>
			      	</button>
			    </div>

			    <div class="col-lg-2 col-md-2 col-xs-12">
			      	<button class="btn btn-app btn-danger">
			        	<div>Pembayaran<br/>Biaya</div>
		        		<div style="font-size:25px;margin-top:-10px" id="load_loket3"></div>
				        <div style="border-bottom:1px solid #fff"></div>
		        		<div>Loket 3</div>
			      	</button>
			    </div>

			    <div class="col-lg-2 col-md-2 col-xs-12">
			      	<button class="btn btn-app btn-info">
			        	<div>Penyerahan<br/>Produk</div>
		        		<div style="font-size:25px;margin-top:-10px" id="load_loket4"></div>
				        <div style="border-bottom:1px solid #fff"></div>
		        		<div>Loket 4</div>
			      	</button>
			    </div>
				
				<div class="col-lg-2 col-md-2 col-xs-12">
			      	<button class="btn btn-app btn-primary">
			        	<div>UMUM &<br/>Surat Masuk </div>
		        		<div style="font-size:25px;margin-top:-10px" id="load_loket5"></div>
				        <div style="border-bottom:1px solid #fff"></div>
		        		<div>Loket 5</div>
			      	</button>
			    </div>
				
				<div class="col-lg-2 col-md-2 col-xs-12">
			      	<button class="btn btn-app btn-black">
			        	<div>E-Court &<br/>Gugatan Mandiri</div>
		        		<div style="font-size:25px;margin-top:-10px" id="load_loket6"></div>
				        <div style="border-bottom:1px solid #fff"></div>
		        		<div>Loket 6</div>
			      	</button>
			    </div>
		  	</div>
		</div>
	</div><!-- /.row -->
</div>

<script type="text/javascript">
$(document).ready(function(){ 
    $('#load_antrian').load('pages/beranda/getAntrian.php');
    $('#load_loket1').load('pages/beranda/getLoket1.php');
    $('#load_loket2').load('pages/beranda/getLoket2.php');
    $('#load_loket3').load('pages/beranda/getLoket3.php');
    $('#load_loket4').load('pages/beranda/getLoket4.php');
	$('#load_loket5').load('pages/beranda/getLoket5.php');
    $('#load_loket6').load('pages/beranda/getLoket6.php');

    setInterval( function () {
    	$('#load_antrian').load('pages/beranda/getAntrian.php');
	    $('#load_loket1').load('pages/beranda/getLoket1.php');
	    $('#load_loket2').load('pages/beranda/getLoket2.php');
	    $('#load_loket3').load('pages/beranda/getLoket3.php');
	    $('#load_loket4').load('pages/beranda/getLoket4.php');
		$('#load_loket5').load('pages/beranda/getLoket5.php');
		$('#load_loket6').load('pages/beranda/getLoket6.php');
       	table.ajax.reload( null, false );
    }, 1000); // refresh setiap 5000 milliseconds
}); 
</script>
<script async="" src="https://www.youtube.com/iframe_api"></script>
<script>
 function onYouTubeIframeAPIReady() {
  var player;
  player = new YT.Player('muteYouTubeVideoPlayer', {
    videoId: 'cpiexoTuY80', // YouTube Video ID
    width: 626,               // panjang video (in px)
    height: 326,              // lebar video (in px)
    playerVars: {
      autoplay: 1,        // Auto-play ketika video dimuat
      controls: 0,        // Menyembunyikan play/pause
      showinfo: 0,        // Menyembunyikan judul video
      modestbranding: 0,  // Menyembunyikan logo Youtube ketika video diputar
      loop: 1,            // Mengulang video lagi ketika selesai diputar
      fs: 0,              // Menyembunyikan tombol fullscreen
      cc_load_policty: 0, // Menyembunyikan captions
      iv_load_policy: 3,  // Menyembunyikan anotasi
      autohide: 1         // Menyembunyikan kontrol video
	//  refresh : 1
    },
    events: {
      onReady: function(e) {
        e.target.mute();
      }
    }
  });
 }
</script>