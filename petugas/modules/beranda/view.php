<?php  
// panggil fungsi untuk format tanggal
include "../config/fungsi_tanggal.php";

// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login
if (empty($_SESSION['antrian_user_account_name']) && empty($_SESSION['antrian_user_account_password'])){
    echo "<meta http-equiv='refresh' content='0; url=../../login-error'>";
}
// jika user sudah login, maka jalankan perintah untuk insert, update, dan delete
else { ?>    
    
    <div class="content-body">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-xs-12">
                <div class="alert alert-success alert-success fade in mb-2" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong><i style="margin-right:7px" class="icon-info"></i></strong> Selamat datang <strong><?php echo $_SESSION['antrian_fullname']; ?></strong>.
                    Anda login sebagai <strong><?php echo $_SESSION['antrian_user_permissions']; ?></strong>.
                </div>
            </div>

            <div class="col-md-6 col-lg-3 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-block">
                            <div class="media">
                                <div class="media-body text-xs-left">
                                    <h3 class="pink">2</h3>
                                    <span>Loket</span>
                                </div>
                                <div class="media-right media-middle">
                                    <i class="icon-users pink font-large-2 float-xs-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-block">
                            <div class="media">
                                <div class="media-body text-xs-left">
                                <?php  
                                // fungsi query untuk menampilkan jumlah data user
                                $result = $mysqli->query("SELECT count(userID) as jumlah FROM sys_users")
                                                                or die('Ada kesalahan pada query tampil jumlah data user: '.$mysqli->error);

                                $data = $result->fetch_assoc();
                                $total_user = $data['jumlah'];
                                ?>
                                    <h3 class="deep-orange"><?php echo number_format($total_user); ?></h3>
                                    <span>Pengguna Aplikasi</span>
                                </div>
                                <div class="media-right media-middle">
                                    <i class="icon-user1 deep-orange font-large-2 float-xs-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-block">
                            <div class="media">
                                <div class="media-body text-xs-left">
                                <?php  
                                // fungsi query untuk menampilkan tanggal terakhir backup database
                                $result = $mysqli->query("SELECT dbID, created_date FROM sys_database ORDER BY dbID DESC LIMIT 1")
                                                          or die('Ada kesalahan pada query tampil data backup database: '.$mysqli->error);
                                $rows  = $result->num_rows;

                                if ($rows > 0) {
                                    $data = $result->fetch_assoc();

                                    $tgl  = substr($data['created_date'],0,10);
                                    $exp  = explode('-',$tgl);
                                    $date = $exp[2]."-".$exp[1]."-".$exp[0];
                                    echo "<h3 class='teal'>$date</h3>";
                                } else {
                                    echo "<h3 class='teal'>-</h3>";
                                }
                                ?>
                                    <span>Backup Database</span>
                                </div>
                                <div class="media-right media-middle">
                                    <i class="icon-database teal font-large-2 float-xs-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-block">
                            <div class="media">
                                <div class="media-body text-xs-left">
                                <?php  
                                $hari_ini = gmdate("d-m-Y", time()+60*60*7);
                                ?>
                                    <h3 class="cyan"><?php echo $_SESSION['antrian_user_permissions']; ?></h3>
                                    <span><?php echo tgl_eng_to_ind("$hari_ini"); ?></span>
                                </div>
                                <div class="media-right media-middle">
                                    <i class="icon-calendar3 cyan font-large-2 float-xs-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6 col-lg-6 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-block">
                            <h4 class="card-title center"><i class="icon-users2"></i> Jumlah Antrian Pengunjung Hari ini</h4>
                        </div>
                        <div id="load_antrian_hari"></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-xs-12">
                <div class="card border-grey border-lighten-3 m-0">
                    <div class="no-border">
                        <div class="card-title text-xs-center">
                            <div class="p-1">
                                <img src="assets/images/logo-instansi/<?php echo $logo; ?>" alt="logo" class="center-block mb-1" width="17%">
                                <h4><?php echo strtoupper($nama_instansi); ?></h4>
                            </div>
                        </div>
                    </div>
                    <div style="margin-top:-30px;" class="card-header no-border">
                        <h6 class="card-subtitle line-on-side text-muted text-xs-center font-small-3"><span>Profil Perusahaan / Instansi</span></h6>
                    </div>
                    <div style="margin-top:-10px;" class="card-body">
                        <div class="card-block-login">
                            <table class="profil-instansi">
                                <tr>
                                    <td width="25" valign="top"><i class="icon-location22"></i></td>
                                    <td valign="top"></i> <?php echo $alamat; ?></td>
                                </tr>
                                <tr>
                                    <td width="25" valign="middle"><i class="icon-phone"></i></td>
                                    <td valign="middle"></i> <?php echo $telepon; ?></td>
                                </tr>
                                <tr>
                                    <td width="25" valign="middle"><i class="icon-envelop"></i></td>
                                    <td valign="middle"></i> <?php echo $email; ?></td>
                                </tr>
                                <tr>
                                    <td width="25" valign="middle"><i class="icon-earth2"></i></td>
                                    <td valign="middle"></i> <?php echo $website; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- auto refresh jumlah antrian pengunjung -->
    <script type="text/javascript">
    $(document).ready(function() {
        $('#load_antrian_hari').load('modules/beranda/getAntrianHari.php');
        
        var auto_refresh = setInterval(
        function () {
           $('#load_antrian_hari').load('modules/beranda/getAntrianHari.php').fadeIn("slow");
        }, 10000); // refresh setiap 10000 milliseconds
    } );
    </script>
<?php  
}
?>