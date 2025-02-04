<?php
session_start();

// Panggil koneksi config.php untuk koneksi database
require_once "../../../config/config.php";

// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login
if (empty($_SESSION['antrian_user_account_name']) && empty($_SESSION['antrian_user_account_password'])){
    echo "<meta http-equiv='refresh' content='0; url=../../login-error'>";
}
// jika user sudah login, maka jalankan perintah untuk insert, update, dan delete
else {
    // jika action = insert maka jalankan perintah insert data
    if ($_GET['act']=='insert') {
        if (isset($_POST['simpan'])) {
            // fungsi untuk membuat userID
            $result = $mysqli->query("SELECT max(userID) as kode FROM sys_users")
                                      or die('Ada kesalahan pada query tampil data userID: '.$mysqli->error);
            $data = $result->fetch_assoc();

            $userID                = $data['kode'] + 1;
            // ambil data hasil submit dari form
            $fullname              = $mysqli->real_escape_string(trim($_POST['fullname']));
            $user_account_name     = $mysqli->real_escape_string(trim($_POST['user_account_name']));
            $user_account_password = sha1(md5($mysqli->real_escape_string(trim($_POST['user_account_password']))));
            $user_permissions      = $mysqli->real_escape_string(trim($_POST['user_permissions']));
            $block_users           = $mysqli->real_escape_string(trim($_POST['block_users']));
            
            $created_user          = $_SESSION['antrian_userID'];

            // perintah query untuk mengecek username
            $result = $mysqli->query("SELECT user_account_name FROM sys_users WHERE user_account_name='$user_account_name'")
                                      or die('Ada kesalahan pada query tampil data user_account_name: '.$mysqli->error);
            $rows = $result->num_rows;

            // jika username sudah ada
            if ($rows > 0) {
                // tampilkan pesan gagal simpan data
                header("location: ../../user-error1-$user_account_name");
            }
            // jika username belum ada
            else {
                // perintah query untuk menyimpan data ke tabel sys_users
                $insert = $mysqli->query("INSERT INTO sys_users(userID,fullname,user_account_name,user_account_password,user_permissions,block_users,created_user)
                                          VALUES('$userID','$fullname','$user_account_name','$user_account_password','$user_permissions','$block_users','$created_user')")
                                          or die('Ada kesalahan pada query insert : '.$mysqli->error);

                // cek query
                if ($insert) {
                    // jika berhasil tampilkan pesan berhasil simpan data
                    header("location: ../../user-success-add");
                }
            }
        }   
    }
    
    // jika action = update maka jalankan perintah update data
    elseif ($_GET['act']=='update') {
        if (isset($_POST['simpan'])) {
            if (isset($_POST['id'])) {
                // ambil data hasil submit dari form
                $userID                = $mysqli->real_escape_string(trim($_POST['id']));
                $fullname              = $mysqli->real_escape_string(trim($_POST['fullname']));
                $user_account_name     = $mysqli->real_escape_string(trim($_POST['user_account_name']));
                $user_account_password = sha1(md5($mysqli->real_escape_string(trim($_POST['user_account_password']))));
                $user_permissions      = $mysqli->real_escape_string(trim($_POST['user_permissions']));
                $block_users           = $mysqli->real_escape_string(trim($_POST['block_users']));
                
                $updated_user          = $_SESSION['antrian_userID'];
                $updated_date          = gmdate("Y-m-d H:i:s", time()+60*60*7);

                // jika password tidak diubah
                if (empty($_POST['user_account_password'])) {
                    // perintah query untuk mengubah data pada tabel sys_users
                    $update = $mysqli->query("UPDATE sys_users SET  fullname            = '$fullname',
                                                                    user_account_name   = '$user_account_name',
                                                                    user_permissions    = '$user_permissions',
                                                                    block_users         = '$block_users',
                                                                    updated_user        = '$updated_user',
                                                                    updated_date        = '$updated_date'
                                                              WHERE userID              = '$userID'")
                                              or die('Ada kesalahan pada query update : '.$mysqli->error);

                    // cek query
                    if ($update) {
                        // jika berhasil tampilkan pesan berhasil update data
                        header("location: ../../user-success-update");
                    }   
                }
                // jika password diubah
                else {
                    // perintah query untuk mengubah data pada tabel sys_users
                    $update = $mysqli->query("UPDATE sys_users SET  fullname                = '$fullname',
                                                                    user_account_name       = '$user_account_name',
                                                                    user_account_password   = '$user_account_password',
                                                                    user_permissions        = '$user_permissions',
                                                                    block_users             = '$block_users',
                                                                    updated_user            = '$updated_user',
                                                                    updated_date            = '$updated_date'
                                                              WHERE userID                  = '$userID'")
                                              or die('Ada kesalahan pada query update : '.$mysqli->error);

                    // cek query
                    if ($update) {
                        // jika berhasil tampilkan pesan berhasil update data
                        header("location: ../../user-success-update");
                    }   
                }
            }
        }
    }      
    
    // jika action = delete maka jalankan perintah delete data
    elseif ($_GET['act']=='delete') {
        if (isset($_GET['id'])) {
            $userID = $_GET['id'];

            // perintah query untuk menampilkan data user dari tabel antrian berdasarkan userID
            $query_antrian = $mysqli->query("SELECT updated_user FROM antrian WHERE updated_user='$userID'")
                                             or die('Ada kesalahan pada query tampil data user: '.$mysqli->error);
            $rows_antrian = $query_antrian->num_rows;

            // perintah query untuk menampilkan data user dari tabel sys_config berdasarkan userID
            $query_config = $mysqli->query("SELECT updated_user FROM sys_config WHERE updated_user='$userID'")
                                            or die('Ada kesalahan pada query tampil data user: '.$mysqli->error);
            $rows_config = $query_config->num_rows;

            // perintah query untuk menampilkan data user dari tabel sys_users berdasarkan userID
            $query_user = $mysqli->query("SELECT created_user, updated_user FROM sys_users WHERE created_user='$userID' OR updated_user='$userID'")
                                          or die('Ada kesalahan pada query tampil data user: '.$mysqli->error);
            $rows_user = $query_user->num_rows;

            // perintah query untuk menampilkan data user dari tabel sys_database berdasarkan userID
            $query_db = $mysqli->query("SELECT created_user FROM sys_database WHERE created_user='$userID'")
                                        or die('Ada kesalahan pada query tampil data user: '.$mysqli->error);
            $rows_db = $query_db->num_rows;

            // jika data ada
            if ($rows_antrian > 0 || $rows_config > 0 || $rows_user > 0 || $rows_db > 0) {
                // tampilkan pesan gagal hapus data
                header("location: user-error2-$userID");
            }
            // jika data tidak ada
            else {
                // perintah query untuk menghapus data pada tabel sys_users
                $delete = $mysqli->query("DELETE FROM sys_users WHERE userID='$userID'")
                                          or die('Ada kesalahan pada query delete : '.$mysqli->error);

                // cek hasil query
                if ($delete) {
                    // jika berhasil tampilkan pesan berhasil delete data
                    header("location: user-success-delete");
                }
            }
        }
    }    
}       
?>