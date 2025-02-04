<?php
session_start();

// Panggil koneksi config.php untuk koneksi database
require_once "../../../config/config.php";

// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login
if (empty($_SESSION['antrian_user_account_name']) && empty($_SESSION['antrian_user_account_password'])){
    echo "<meta http-equiv='refresh' content='0; url=../../login-error'>";
}
// jika user sudah login, maka jalankan perintah untuk ubah data
else {
    if (isset($_POST['simpan'])) {
        if (isset($_POST['configID'])) {
            // ambil data hasil submit dari form
            $configID           = $mysqli->real_escape_string(trim($_POST['configID']));
            $nama_instansi      = $mysqli->real_escape_string(trim($_POST['nama_instansi']));
            $alamat             = $mysqli->real_escape_string(trim($_POST['alamat']));
            $telepon            = $mysqli->real_escape_string(trim($_POST['telepon']));
            $email              = $mysqli->real_escape_string(trim($_POST['email']));
            $website            = $mysqli->real_escape_string(trim($_POST['website']));
            
            $nama_file          = $_FILES['logo']['name'];
            $ukuran_file        = $_FILES['logo']['size'];
            $tipe_file          = $_FILES['logo']['type'];
            $tmp_file           = $_FILES['logo']['tmp_name'];
            
            // tentukan extension yang diperbolehkan
            $allowed_extensions = array('jpg','jpeg','png');
            
            // Set path folder tempat menyimpan gambarnya
            $path               = "../../assets/images/logo-instansi/".$nama_file;
            
            // check extension
            $file               = explode(".", $nama_file);
            $extension          = array_pop($file);
            
            $updated_user       = $_SESSION['antrian_userID'];
            $updated_date       = gmdate("Y-m-d H:i:s", time()+60*60*7);

            // jika logo tidak diubah
            if (empty($nama_file)) {
                // perintah query untuk mengubah data pada tabel sys_config
                $update = $mysqli->query("UPDATE sys_config SET nama_instansi   = '$nama_instansi',
                                                                alamat          = '$alamat',
                                                                telepon         = '$telepon',
                                                                email           = '$email',
                                                                website         = '$website',
                                                                updated_user    = '$updated_user',
                                                                updated_date    = '$updated_date'
                                                          WHERE configID        = '$configID'")
                                          or die('Ada kesalahan pada query update konfigurasi aplikasi : '.$mysqli->error);

                // cek query
                if ($update) {
                    header("location: ../../konfigurasi-aplikasi-success");
                }   
            }
            // jika logo diubah
            else {
                // Cek apakah tipe file yang diupload sesuai dengan allowed_extensions
                if(in_array($extension, $allowed_extensions)) {
                    // Jika tipe file yang diupload sesuai dengan allowed_extensions, lakukan :
                    if($ukuran_file <= 1000000) { // Cek apakah ukuran file yang diupload kurang dari sama dengan 1 Mb
                        // Jika ukuran file kurang dari sama dengan 1 Mb, lakukan :
                        // Proses upload
                        if(move_uploaded_file($tmp_file, $path)) { // Cek apakah gambar berhasil diupload atau tidak
                            // Jika gambar berhasil diupload, Lakukan : 
                            // perintah query untuk menyimpan data ke tabel sys_config
                            $update = $mysqli->query("UPDATE sys_config SET nama_instansi   = '$nama_instansi',
                                                                            alamat          = '$alamat',
                                                                            telepon         = '$telepon',
                                                                            email           = '$email',
                                                                            website         = '$website',
                                                                            logo            = '$nama_file',
                                                                            updated_user    = '$updated_user',
                                                                            updated_date    = '$updated_date'
                                                                      WHERE configID        = '$configID'")
                                                      or die('Ada kesalahan pada query update konfigurasi aplikasi : '.$mysqli->error);

                            // cek query
                            if ($update) {
                                header("location: ../../konfigurasi-aplikasi-success");
                            }
                        } else {
                            // Jika gambar gagal diupload, tampilkan pesan gagal upload
                            header("location: ../../konfigurasi-aplikasi-error1");
                        }
                    } else {
                        // Jika ukuran file lebih dari 1MB, tampilkan pesan gagal upload
                        header("location: ../../konfigurasi-aplikasi-error2");
                    }
                } else {
                    // Jika tipe file yang diupload bukan JPG / JPEG / PNG, tampilkan pesan gagal upload
                    header("location: ../../konfigurasi-aplikasi-error3");
                }
            }
        }
    }   
}               
?>