<?php 
// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login
if (empty($_SESSION['antrian_user_account_name']) && empty($_SESSION['antrian_user_account_password'])){
    echo "<meta http-equiv='refresh' content='0; url=../../login-error'>";
}
// jika user sudah login, maka jalankan perintah untuk insert, update, dan delete
else { 
    // fungsi untuk pengecekan tampilan form
    // jika form add data yang dipilih
    if ($_GET['form']=='add') { ?>
    	<div class="content-header row">
            <div class="content-header-left col-md-6 col-xs-12 mb-1">
                <h3 class="content-header-title"><i class="icon-pencil22"></i> Input User </h3>
            </div>

            <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
                <div class="breadcrumb-wrapper col-xs-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="beranda"><i style="margin-right:7px" class="icon-home3"></i> Beranda</a></li>
                        <li class="breadcrumb-item"><a href="user">User</a></li>
                        <li class="breadcrumb-item active">Tambah</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="content-body"><!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body collapse in">
                                <div class="card-block">
                                    <form class="form" action="modules/user/proses.php?act=insert" method="POST">
                                        <div class="form-body">

                                            <div class="form-group">
                                                <label>Nama User <span class="wajib-isi">*</span></label>
                                                <input type="text" class="form-control" name="fullname" autocomplete="off" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Username <span class="wajib-isi">*</span></label>
                                                <input type="text" class="form-control" name="user_account_name" autocomplete="off" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Password <span class="wajib-isi">*</span></label>
                                                <input type="password" class="form-control" name="user_account_password" autocomplete="off" required>
                                            </div>

                                            <div class="form-group">
    											<label>Hak Akses <span class="wajib-isi">*</span></label>
    											<select class="form-control" name="user_permissions" placeholder="-- Pilih --" autocomplete="off" required>
    												<option value="Administrator">Administrator</option>
    												<option value="Loket 1">Loket 1</option>
                                                    <option value="Loket 2">Loket 2</option>
                                                    <option value="Loket 3">Loket 3</option>
                                                    <option value="Loket 4">Loket 4</option>
													<option value="Loket 5">Loket 5</option>
													<option value="Loket 6">Loket 6</option>
    											</select>
    										</div>

    										<div class="form-group">
    											<label>Blokir User <span class="wajib-isi">*</span></label>
    											<div class="input-group">
    												<label class="display-inline-block custom-control custom-radio ml-1 mr-1">
    													<input type="radio" name="block_users" class="custom-control-input" value="Ya" required>
    													<span class="custom-control-indicator"></span>
    													<span class="custom-control-description ml-0"> Ya </span>
    												</label>
    												<label class="display-inline-block custom-control custom-radio">
    													<input type="radio" name="block_users" class="custom-control-input" checked value="Tidak" required>
    													<span class="custom-control-indicator"></span>
    													<span class="custom-control-description ml-0"> Tidak </span>
    												</label>
    											</div>
    										</div>
                                        </div>

                                        <div class="form-actions">
                                            <input type="submit" class="btn btn-primary btn-simpan mr-1" name="simpan" value="Simpan">
                                            <a href="user" class="btn btn-warning btn-reset"> Batal </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    <?php
    }
    // jika form edit data yang dipilih
    elseif ($_GET['form']=='edit') { 
    	if (isset($_GET['id'])) {
    		$userID = $_GET['id'];
    	    // fungsi query untuk menampilkan data dari tabel user
    	    $result = $mysqli->query("SELECT userID,fullname,user_account_name,user_permissions,block_users FROM sys_users WHERE userID='$userID'") 
    	    						  or die('Ada kesalahan pada query tampil data ubah : '.$mysqli->error);
    	    $data = $result->fetch_assoc();
      	}
    ?>
    	<div class="content-header row">
            <div class="content-header-left col-md-6 col-xs-12 mb-1">
                <h3 class="content-header-title"><i class="icon-pencil22"></i> Ubah Data User </h3>
            </div>

            <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
                <div class="breadcrumb-wrapper col-xs-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="beranda"><i style="margin-right:7px" class="icon-home3"></i> Beranda </a></li>
                        <li class="breadcrumb-item"><a href="user">User</a></li>
                        <li class="breadcrumb-item active">Ubah</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="content-body"><!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body collapse in">
                                <div class="card-block">
                                    <form class="form" action="modules/user/proses.php?act=update" method="POST">
                                        <div class="form-body">
    										
    										<input type="hidden" name="id" value="<?php echo $data['userID']; ?>">

                                            <div class="form-group">
                                                <label>Nama User <span class="wajib-isi">*</span></label>
                                                <input type="text" class="form-control" name="fullname" autocomplete="off" value="<?php echo $data['fullname']; ?>" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Username <span class="wajib-isi">*</span></label>
                                                <input type="text" class="form-control" name="user_account_name" autocomplete="off" value="<?php echo $data['user_account_name']; ?>" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" class="form-control" name="user_account_password" placeholder="Kosongkan password jika tidak diubah" autocomplete="off">
                                            </div>

                                            <div class="form-group">
    											<label>Hak Akses <span class="wajib-isi">*</span></label>
    											<select class="form-control" name="user_permissions" autocomplete="off" required>
    												<option value="<?php echo $data['user_permissions']; ?>"><?php echo $data['user_permissions']; ?></option>
    												<option value="Administrator">Administrator</option>
                                                    <option value="Loket 1">Loket 1</option>
                                                    <option value="Loket 2">Loket 2</option>
                                                    <option value="Loket 3">Loket 3</option>
                                                    <option value="Loket 4">Loket 4</option>
													<option value="Loket 5">Loket 5</option>
													<option value="Loket 6">Loket 6</option>
    											</select>
    										</div>

    										<div class="form-group">
    											<label>Blokir User <span class="wajib-isi">*</span></label>
    											<div class="input-group">
    											<?php  
    											if ($data['block_users']=='Ya') { ?>
    												<label class="display-inline-block custom-control custom-radio ml-1 mr-1">
    													<input type="radio" name="block_users" class="custom-control-input" checked value="Ya" required>
    													<span class="custom-control-indicator"></span>
    													<span class="custom-control-description ml-0"> Ya </span>
    												</label>
    												<label class="display-inline-block custom-control custom-radio">
    													<input type="radio" name="block_users" class="custom-control-input" value="Tidak" required>
    													<span class="custom-control-indicator"></span>
    													<span class="custom-control-description ml-0"> Tidak </span>
    												</label>
    											<?php
    											} elseif ($data['block_users']=='Tidak') { ?>
    												<label class="display-inline-block custom-control custom-radio ml-1 mr-1">
    													<input type="radio" name="block_users" class="custom-control-input" value="Ya" required>
    													<span class="custom-control-indicator"></span>
    													<span class="custom-control-description ml-0"> Ya </span>
    												</label>
    												<label class="display-inline-block custom-control custom-radio">
    													<input type="radio" name="block_users" class="custom-control-input" checked value="Tidak" required>
    													<span class="custom-control-indicator"></span>
    													<span class="custom-control-description ml-0"> Tidak </span>
    												</label>
    											<?php
    											}
    											?>
    											</div>
    										</div>
                                        </div>

                                        <div class="form-actions">
                                            <input type="submit" class="btn btn-primary btn-simpan mr-1" name="simpan" value="Simpan">
                                            <a href="user" class="btn btn-warning btn-reset"> Batal </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    <?php
    }
}
?>