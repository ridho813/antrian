<?php  
// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login
if (empty($_SESSION['antrian_user_account_name']) && empty($_SESSION['antrian_user_account_password'])){
    echo "<meta http-equiv='refresh' content='0; url=../../login-error'>";

}
// jika user sudah login, maka jalankan perintah untuk insert, update, dan delete
else {
    // panggil fungsi untuk format tanggal
    include "../config/fungsi_tanggal.php";
?>    

    <div class="content-body">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-xs-12">
                <div class="alert alert-success alert-success fade in mb-2" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong><i style="margin-right:7px" class="icon-info"></i></strong>Selamat datang 
					<strong><?php echo $_SESSION['antrian_fullname']; ?></strong>.
                    Anda login sebagai user <strong id="userPermission"><?php echo $_SESSION['antrian_user_permissions']; ?></strong>.
                </div>
            </div>

            <div class="col-md-3 col-lg-3 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-block">
                            <div class="media">
                                <div class="media-body text-xs-left">
                                    <div id="load_jumlah_antrian"></div>
                                    <span>Jumlah Antrian</span>
                                </div>
                                <div class="media-right media-middle">
                                    <i class="icon-users2 deep-orange font-large-2 float-xs-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 col-lg-3 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-block">
                            <div class="media">
                                <div class="media-body text-xs-left">
                                    <div id="load_antrian_sekarang"></div>
                                    <span>Antrian Sekarang</span>
                                </div>
                                <div class="media-right media-middle">
                                    <i class="icon-user-check teal font-large-2 float-xs-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 col-lg-3 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-block">
                            <div class="media">
                                <div class="media-body text-xs-left">
                                    <div id="load_antrian_selanjutnya"></div>
                                    <span>Antrian Selanjutnya</span>
                                </div>
                                <div class="media-right media-middle">
                                    <i class="icon-user-plus cyan font-large-2 float-xs-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-lg-3 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-block">
                            <div class="media">
                                <div class="media-body text-xs-left">
                                    <div id="load_sisa_antrian"></div>
                                    <span>Sisa Antrian</span>
                                </div>
                                <div class="media-right media-middle">
                                    <i class="icon-user pink font-large-2 float-xs-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div style="border-top: 1px solid #ddd;padding-bottom:15px;margin-top:-8px"></div>

        <div class="row">
            <div class="col-xl-3 col-lg-3 col-xs-12">
				<button id="loket1_done" class="btn btn-white">
					<div class="card">
						<div class="media" id="load_loket1"></div>
					</div>
				</button>

				<button id="loket2_done" class="btn btn-white">
					<div class="card">
						<div class="media" id="load_loket2"></div>
					</div>
				</button>

				<button id="loket3_done" class="btn btn-white">
					<div class="card">
						<div class="media" id="load_loket3"></div>
					</div>
				</button>
            </div>
			
			<div class="col-xl-3 col-lg-3 col-xs-12">
				<button id="loket4_done" class="btn btn-white">
					<div class="card">
						<div class="media" id="load_loket4"></div>
					</div>
				</button>

				<button id="loket5_done" class="btn btn-white">
					<div class="card">
						<div class="media" id="load_loket5"></div>
					</div>
				</button>

				<button id="loket6_done" class="btn btn-white">
					<div class="card">
						<div class="media" id="load_loket6"></div>
					</div>
				</button>
            </div>

            <div class="col-xl-6 col-lg-6 col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><i class="icon-users2"></i> Panggil Antrian</h4>
                        <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                                <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body collapse in">
                        <div class="card-block card-dashboard">
                            <table id="tabel-antrian" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nomor Antrian</th>
                                        <th>Panggil</th>
                                        <th>Loket</th>
                                        <th>Status</th>
                                        <th>Panggil</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <audio id="tingtung" src="assets/audio/tingtung.mp3"></audio>

    <!-- auto refresh jumlah antrian pengunjung -->
    <script type="text/javascript">
    $(document).ready(function() {	
        $('#load_jumlah_antrian').load('modules/antrian/getJumlahAntrian.php');
        $('#load_antrian_sekarang').load('modules/antrian/getAntrianSekarang.php');
        $('#load_antrian_selanjutnya').load('modules/antrian/getAntrianSelanjutnya.php');
        $('#load_sisa_antrian').load('modules/antrian/getSisaAntrian.php');

        $('#load_loket1').load('modules/antrian/getLoket1.php');
        $('#load_loket2').load('modules/antrian/getLoket2.php');
        $('#load_loket3').load('modules/antrian/getLoket3.php');
        $('#load_loket4').load('modules/antrian/getLoket4.php');
		$('#load_loket5').load('modules/antrian/getLoket5.php');
		$('#load_loket6').load('modules/antrian/getLoket6.php');
		
        // initiate dataTables plugin
        var table = $('#tabel-antrian').DataTable( {
            "bAutoWidth": false,
            "lengthChange": false,
            "searching": false,
            "serverSide": true,
            "ajax": 'modules/antrian/data.php',
            "columnDefs": [ 
                { "targets": 0, "width": '100px', "className": 'center' },
                { "targets": 1, "visible": false },
                { "targets": 2, "width": '100px', "className": 'center' },
                { "targets": 3, "visible": false },
                {
                  "targets": 4, "data": null, "orderable": false, "searchable": false, "width": '80px', "className": 'center',
                  "render": function(data, type, row) {
                      if (data[3] === '0') {
                          var btn = "<button data-toggle=\"tooltip\" data-placement=\"top\" title=\"Panggil\" class=\"btn btn-info btn-sm\"><i class=\"icon-mic\"></i>";
                      } else if (data[ 3 ]==='1') {
                          var btn = "<button data-toggle=\"tooltip\" data-placement=\"top\" title=\"Panggil\" class=\"btn btn-primary btn-sm\"><i class=\"icon-mic\"></i></button>"
                      }else {
                          var btn = "<button data-toggle=\"tooltip\" data-placement=\"top\" title=\"Panggil\" class=\"btn btn-danger btn-sm\"><i class=\"icon-mic\"></i></button>";
                      };
                      return btn;
                  } 
                } 
            ],
            "order": [[ 0, "asc" ]],
            "iDisplayLength": 8
        } );

        $('#tabel-antrian tbody').on( 'click', 'button', function () {
            var data = table.row( $(this).parents('tr') ).data();
            var ID   = data[ 4 ];
            var bell = document.getElementById('tingtung');

			if (data[3] === '2') {
				
			} else {
				$.ajax({ 
					url   : "modules/antrian/proses.php",
					type  : "POST",
					data  : { ID : ID , status : "1"},
					cache : false,
					success: function(msg){ 
						if(msg=="Sukses"){ 
							// MAINKAN SUARA BEL PADA SAAT AWAL
							bell.pause();
							bell.currentTime=0;
							bell.play();

							// SET DELAY UNTUK MEMAINKAN REKAMAN NOMOR URUT  
							totalwaktu = bell.duration * 700; 

							// MAINKAN SUARA NOMOR URUT  
							setTimeout(function() {
								return responsiveVoice.speak(" Nomor Antrian," +data[ 1 ]+ ", ke , "+data[ 2 ]+"","Indonesian Female", {rate: 0.8, pitch: 1, volume: 1});
							}, totalwaktu);

							totalwaktu = totalwaktu + 700;
						}
					}
				});
			}        
        } );
		
		var userPermission = $('#userPermission').text();
		
		$('#loket1_done').on('click', function() {
			if (userPermission == 'Loket 1') {
				var no = $('#loket1_tiket').text();
				antrian_selesai(no);
			}
		} );
		
		$('#loket2_done').on('click', function() {
			if (userPermission == 'Loket 2') {
				var no = $('#loket2_tiket').text();
				antrian_selesai(no);
			}
		} );
		$('#loket3_done').on('click', function() {
			if (userPermission == 'Loket 3') {
				var no = $('#loket3_tiket').text();
				antrian_selesai(no);
			}
		} );
		$('#loket4_done').on('click', function() {
			if (userPermission == 'Loket 4') {
				var no = $('#loket4_tiket').text();
				antrian_selesai(no);
			}
		} );
		$('#loket5_done').on('click', function() {
			if (userPermission == 'Loket 5') {
				var no = $('#loket5_tiket').text();
				antrian_selesai(no);
			}
		} );
		$('#loket6_done').on('click', function() {
			if (userPermission == 'Loket 6') {
				var no = $('#loket6_tiket').text();
				antrian_selesai(no);
			}
		} );
		
		function antrian_selesai(i) {
			$.ajax( {
					url   : "modules/antrian/proses2.php",
					type  : "POST",
					data  : {'no_antrian' : i},
					cache : false,
					success: function(msg){ 
						if(msg=="Sukses"){ 
							//alert("hello");
						}
					}
			} );
		}

        setInterval( function () {
            $('#load_jumlah_antrian').load('modules/antrian/getJumlahAntrian.php').fadeIn("slow");
            $('#load_antrian_sekarang').load('modules/antrian/getAntrianSekarang.php');
            $('#load_antrian_selanjutnya').load('modules/antrian/getAntrianSelanjutnya.php');
            $('#load_sisa_antrian').load('modules/antrian/getSisaAntrian.php');
            $('#load_loket1').load('modules/antrian/getLoket1.php');
            $('#load_loket2').load('modules/antrian/getLoket2.php');
            $('#load_loket3').load('modules/antrian/getLoket3.php');
            $('#load_loket4').load('modules/antrian/getLoket4.php');
			$('#load_loket5').load('modules/antrian/getLoket5.php');
			$('#load_loket6').load('modules/antrian/getLoket6.php');
            table.ajax.reload( null, false );
        }, 1000); // refresh setiap 5000 milliseconds
    } );
    </script>
<?php  
}
?>