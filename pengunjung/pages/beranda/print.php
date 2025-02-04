<?php 
// set default timezone
date_default_timezone_set("ASIA/JAKARTA");

// panggil file config.php untuk koneksi ke database
require_once "../../../config/config.php";
// panggil file fungsi nama hari
require_once "../../../config/fungsi_nama_hari.php";

$hari_ini = gmdate("Y-m-d", time()+60*60*7);

$configID = "1";
// fungsi query untuk menampilkan data dari tabel sys_config
$result = $mysqli->query("SELECT nama_instansi FROM sys_config WHERE configID='$configID'")
                          or die('Ada kesalahan pada query tampil data config: '.$mysqli->error);
$data_config = $result->fetch_assoc();

// fungsi query untuk menampilkan data dari tabel antrian
$result = $mysqli->query("SELECT max(no_antrian) as nomor, loket FROM antrian WHERE tanggal='$hari_ini' ORDER BY no_antrian DESC LIMIT 1")
                          or die('Ada kesalahan pada query tampil nomor antrian: '.$mysqli->error);
$data = $result->fetch_assoc();

$nama_instansi  = $data_config['nama_instansi'];
$loket          = $data['loket'];
$no_antrian     = $data['nomor'];
$hari           = nama_hari(date("Y-m-d"));
$tanggal        = date("d-m-Y");
$jam            = date("H:i:s");
$var_magin_left = 10;
$row            = 0;
$p              = printer_open('POS-80CA');

printer_set_option($p, PRINTER_MODE, "RAW"); // mode disobek (gak ngegulung kertas)
//then the width
printer_set_option($p, PRINTER_RESOLUTION_Y, 940);
printer_start_doc($p);
printer_start_page($p);

$font = printer_create_font("Arial", 45, 10, PRINTER_FW_NORMAL, false, false, false, 0);
printer_select_font($p, $font);
printer_draw_text($p, $nama_instansi,$var_magin_left,0);

$pen = printer_create_pen(PRINTER_PEN_SOLID, 2, "000000");
printer_select_pen($p, $pen);
printer_draw_line($p, $var_magin_left, 55, 700, 55);

// Header Bon
$font = printer_create_font("Arial", 25, 10, PRINTER_FW_NORMAL, false, false, false, 0);
printer_select_font($p, $font);
printer_draw_text($p, $hari, $var_magin_left, 70);
printer_draw_text($p, ", ",75, 70);
printer_draw_text($p, date("d/m/Y"),90, 70);
printer_draw_text($p, " - ",200, 70);
printer_draw_text($p, date("H:i"),220, 70);

$font = printer_create_font("Arial", 38, 11, PRINTER_FW_NORMAL, false, false, false, 0);
printer_select_font($p, $font);
printer_draw_text($p, "Nomor Antrian ".$loket, 160, 130);	

$font = printer_create_font("Arial", 98, 37, PRINTER_FW_NORMAL, false, false, false, 0);
printer_select_font($p, $font);
printer_draw_text($p, $no_antrian, 210, 170);


$pen = printer_create_pen(PRINTER_PEN_SOLID, 2, "000000");
printer_select_pen($p, $pen);
printer_draw_line($p, $var_magin_left, 280, 700, 280);

$font = printer_create_font("Arial", 20, 12, PRINTER_FW_NORMAL, false, false, false, 0);
printer_select_font($p, $font);
printer_draw_text($p, "\"Budayakan Antri Untuk Kenyamanan \n Bersama\"", $var_magin_left, 290);
printer_draw_text($p, "Terimakasih Atas Kunjungan Anda", 100, 310);

$row +=350;
printer_draw_text($p, ". ", 0, $row);
                           
printer_delete_font($font);

printer_end_page($p);
printer_end_doc($p);

printer_start_doc($p);
printer_start_page($p);
printer_close($p);
?>
