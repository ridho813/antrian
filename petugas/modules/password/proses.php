<?php
session_start();

// Panggil koneksi config.php untuk koneksi database
require_once "../../../config/config.php";

// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login
if (empty($_SESSION['antrian_user_account_name']) && empty($_SESSION['antrian_user_account_password'])){
    echo "<meta http-equiv='refresh' content='0; url=../../login-error'>";
}
// jika user sudah login, maka jalankan perintah untuk ubah password
else {
    if (isset($_POST['simpan'])) {
        if (isset($_SESSION['antrian_userID'])) {
            // ambil data hasil submit dari form
            $old_pass     = sha1(md5($mysqli->real_escape_string(trim($_POST['old_pass']))));
            $new_pass     = sha1(md5($mysqli->real_escape_string(trim($_POST['new_pass']))));
            $retype_pass  = sha1(md5($mysqli->real_escape_string(trim($_POST['retype_pass']))));

            $updated_date = gmdate("Y-m-d H:i:s", time()+60*60*7);
            // ambil data hasil session user
            $userID       = $_SESSION['antrian_userID'];

            // seleksi password dari tabel sys_users untuk dicek
            $result = $mysqli->query("SELECT user_account_password FROM sys_users WHERE userID='$userID'")
                                      or die('Ada kesalahan pada query seleksi password : '.$mysqli->error);
            $data = $result->fetch_assoc();

            // fungsi untuk pengecekan password sebelum diubah 
            // jika input password lama tidak sama dengan password di database, 
            // alihkan ke halaman ubah password dan tampilkan pesan = 1
            if ($old_pass != $data['user_account_password']){
                header("Location: ../../password-error1");
            }
            // jika input password lama sama dengan password didatabase, jalankan perintah untuk pengecekan selanjutnya
            else {
                // jika input password baru tidak sama dengan input ulangi password baru, 
                // alihkan ke halaman ubah password dan tampilkan pesan = 2 
                if ($new_pass != $retype_pass){
                    header("Location: ../../password-error2");
                }
                // selain itu, jalankan perintah update password
                else {
                    // perintah query untuk mengubah data pada tabel sys_users
                    $update = $mysqli->query("UPDATE sys_users SET user_account_password    = '$new_pass',
                                                                   updated_user             = '$userID',
                                                                   updated_date             = '$updated_date'
                                                             WHERE userID='$userID'")
                                              or die('Ada kesalahan pada query update password : '.$mysqli->error);  
                    // cek query
                    if ($update) {
                        // jika berhasil tampilkan pesan berhasil update data
                        header("location: ../../password-success");
                    }   
                }
            }
        }
    }   
}               
?>