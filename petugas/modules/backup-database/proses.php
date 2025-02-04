<?php
session_start();

// Panggil koneksi config.php untuk koneksi database
require_once "../../../config/config.php";
// panggil file fungsi_backup_import.php untuk backup database
require_once "../../../config/fungsi_backup_import.php";
// panggil file fungsi_file_size.php untuk mengetahui file size database
require_once "../../../config/fungsi_file_size.php";

// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login
if (empty($_SESSION['antrian_user_account_name']) && empty($_SESSION['antrian_user_account_password'])){
    echo "<meta http-equiv='refresh' content='0; url=../../login-error'>";
}
// jika user sudah login, maka jalankan perintah untuk backup, insert, delete
else {
    // jika action = backup maka jalankan perintah untuk backup dan insert data
    if ($_GET['act']=='backup') {
        $date = gmdate("Ymd_His", time()+60*60*7);  // waktu backup
        $dir  = "../../../database";                   // direktori file backup
        $name = $date.'_database';                  // nama sql backup
        // jalankan perintah backup database
        $backup = backup_database( $dir, $name, $con['host'], $con['user'], $con['pass'], $con['db']);

        // fungsi untuk pengecekan proses backup
        // jika backup berhasil
        if ($backup) {
            // fungsi untuk membuat dbID
            $result = $mysqli->query("SELECT max(dbID) as kode FROM sys_database")
                                      or die('Ada kesalahan pada query tampil data id db: '.$mysqli->error);
            $data = mysqli_fetch_assoc($result);
            $dbID = $data['kode'] + 1;

            $file_name    = $name.".sql.gz";
            $file_dir     = $dir."/".$file_name;
            $file_size    = MakeReadable(filesize($file_dir));
            $created_user = $_SESSION['antrian_userID'];

            // perintah query untuk menyimpan data ke tabel sys_database
            $insert = $mysqli->query("INSERT INTO sys_database(dbID,file_name,file_size,created_user)
                                      VALUES('$dbID','$file_name','$file_size','$created_user')")
                                      or die('Ada kesalahan pada query insert : '.$mysqli->error);    

            // cek query
            if ($insert) {
                // jika berhasil tampilkan pesan berhasil backup database
                header("location: backup-database-success");
            }  
        }    
    }  

    // jika action = delete maka jalankan perintah delete data
    elseif ($_GET['act']=='delete') {
        if (isset($_GET['id'])) {
            $dbID = $_GET['id'];
            // perintah query untuk menampilkan data file_name berdasaran dbID
            $result = $mysqli->query("SELECT file_name FROM sys_database WHERE dbID='$dbID'")
                                      or die('Ada kesalahan pada query tampil file_name: '.$mysqli->error);
            $data = $result->fetch_assoc();
            $file_name = $data['file_name'];
            
            // hapus file file_name dari folder database
            $hapus_file = unlink("../../../database/$file_name");   

            // cek hapus file
            if ($hapus_file) {
                // perintah query untuk menghapus data pada tabel sys_database
                $delete = $mysqli->query("DELETE FROM sys_database WHERE dbID='$dbID'")
                                          or die('Ada kesalahan pada query delete : '.$mysqli->error);

                // cek hasil query
                if ($delete) {
                    // jika berhasil tampilkan pesan berhasil delete data
                    header("location: backup-database-success-delete");
                }
            }
        }
    }
}       
?>