<?php
// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login
if (empty($_SESSION['antrian_user_account_name']) && empty($_SESSION['antrian_user_account_password'])){
    echo "<meta http-equiv='refresh' content='0; url=../../login-error'>";
}
// jika user sudah login, maka jalankan perintah untuk insert, update, dan delete
else {
    $configID = '1';
    // fungsi query untuk menampilkan data dari tabel sys_config
    $result = $mysqli->query("SELECT configID, nama_instansi, alamat, telepon, email, website, logo FROM sys_config WHERE configID='$configID'") 
                              or die('Ada kesalahan pada query tampil data konfigurasi aplikasi : '.$mysqli->error);
    $data = $result->fetch_assoc();
?>
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-xs-12 mb-1">
            <h3 class="content-header-title"><i class="icon-cog"></i> Konfigurasi Aplikasi </h3>
        </div>

        <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
            <div class="breadcrumb-wrapper col-xs-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="beranda"><i style="margin-right:7px" class="icon-home3"></i> Beranda</a></li>
                    <li class="breadcrumb-item active">Aplikasi</li>
                    <li class="breadcrumb-item active">Konfigurasi</li>
                </ol>
            </div>
        </div>
    </div>

<?php  
// fungsi untuk menampilkan pesan
// jika alert = "" (kosong)
// tampilkan pesan "" (kosong)
if (empty($_GET['alert'])) { ?>
    <div></div>
<?php
}
// jika alert = 1
// tampilkan pesan Sukses "Data instansi berhasil diubah"
elseif ($_GET['alert'] == 1) { ?>
    <div class="alert alert-success alert-dismissible fade in mb-2" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong><i style="margin-right:7px" class="icon-checkmark2"></i>Sukses!</strong> Data instansi berhasil diubah.
    </div>
<?php
}
// jika alert = 2
// tampilkan pesan Gagal "Pastikan file yang diupload sudah benar"
elseif ($_GET['alert'] == 2) { ?>
    <div class="alert alert-danger alert-dismissible fade in mb-2" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong><i style="margin-right:7px" class="icon-cancel-circle"></i>Upload Gagal!</strong> Pastikan file yang diupload sudah benar.
    </div>
<?php
} 
// jika alert = 3
// tampilkan pesan Sukses "Pastikan ukuran file tidak lebih dari 1 Mb"
elseif ($_GET['alert'] == 3) { ?>
    <div class="alert alert-danger alert-dismissible fade in mb-2" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong><i style="margin-right:7px" class="icon-cancel-circle"></i>Upload Gagal!</strong> Pastikan ukuran file tidak lebih dari 1 Mb.
    </div>
<?php
}
// jika alert = 4
// tampilkan pesan Sukses "Pastikan file yang diupload bertipe *.JPG / *.PNG."
elseif ($_GET['alert'] == 4) { ?>
    <div class="alert alert-danger alert-dismissible fade in mb-2" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong><i style="margin-right:7px" class="icon-cancel-circle"></i>Upload Gagal!</strong> Pastikan file yang diupload bertipe *.JPG / *.PNG.
    </div>
<?php
}
?>

    <div class="content-body"><!-- Basic form layout section start -->
        <section id="basic-form-layouts">
            <div class="row match-height">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body collapse in">
                            <div class="card-block">
                            <?php  
                            if (empty($_POST['configID'])) { ?>
                                <form class="form" action="konfigurasi-aplikasi" method="POST">

                                    <input type="hidden" name="configID" value="<?php echo $data['configID']; ?>" />

                                    <div class="form-body">
                                        <div class="form-group">
                                            <label>Nama Perusahaan / Instansi</label>
                                            <input type="text" class="form-control" name="nama_instansi" value="<?php echo $data['nama_instansi']; ?>" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea rows="2" class="form-control" name="alamat" readonly><?php echo $data['alamat']; ?></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>Telepon</label>
                                            <input type="text" class="form-control" name="telepon" value="<?php echo $data['telepon']; ?>" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" value="<?php echo $data['email']; ?>" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label>Website</label>
                                            <input type="text" class="form-control" name="website" value="<?php echo $data['website']; ?>" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label>Logo</label>
                                            <br>
                                            <?php  
                                            if ($data['logo']=='') { ?>
                                                <img class="config-logo" alt="Logo" src="assets/images/no_image_300x300.gif" width="250" />
                                            <?php
                                            } else { ?>
                                                <img class="config-logo" alt="Logo" src="assets/images/logo-instansi/<?php echo $data['logo']; ?>" width="250" />
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <input type="submit" class="btn btn-primary btn-simpan mr-1" name="ubah" value="Ubah">
                                    </div>
                                </form>
                            <?php  
                            } else { ?>
                                <form class="form" action="modules/konfigurasi/proses.php" method="POST" enctype="multipart/form-data">

                                    <input type="hidden" name="configID" value="<?php echo $_POST['configID']; ?>" />

                                    <div class="form-body">
                                        <div class="form-group">
                                            <label>Nama Perusahaan / Instansi <span class="wajib-isi">*</span></label>
                                            <input type="text" class="form-control" name="nama_instansi" autocomplete="off" value="<?php echo $_POST['nama_instansi']; ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Alamat <span class="wajib-isi">*</span></label>
                                            <textarea rows="2" class="form-control" name="alamat" autocomplete="off" required><?php echo $_POST['alamat']; ?></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>Telepon <span class="wajib-isi">*</span></label>
                                            <input type="text" class="form-control" name="telepon" autocomplete="off" maxlength="13" value="<?php echo $_POST['telepon']; ?>" onKeyPress="return goodchars(event,'0123456789',this)" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Email <span class="wajib-isi">*</span></label>
                                            <input type="email" class="form-control" name="email" autocomplete="off" value="<?php echo $_POST['email']; ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Website <span class="wajib-isi">*</span></label>
                                            <input type="text" class="form-control" name="website" autocomplete="off" value="<?php echo $_POST['website']; ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label class="mt-1 mr-1">Logo</label>
                                            <label class="file center-block">
                                                <input type="file" id="file" name="logo" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Pastikan file yang diupload bertipe *.JPG / *.PNG dan ukuran file maksimal 1 Mb" autocomplete="off">
                                                <span class="file-custom"></span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <input type="submit" class="btn btn-primary btn-simpan mr-1" name="simpan" value="Simpan">
                                        <a href="konfigurasi-aplikasi" class="btn btn-warning btn-reset"> Batal </a>
                                    </div>
                                </form>
                            <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php  
}
?>