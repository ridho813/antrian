<?php
$tmpdir = sys_get_temp_dir();
$file = tempnam($tmpdir, 'ctk');
$handle = fopen($file, 'w');
$condensed = Chr(27) . Chr(33) . Chr(4);
$bold1 = Chr(27) . Chr(69);
$bold0 = Chr(27) . Chr(70);
$initialized = chr(27).chr(64);
$condensed1 = chr(15);
$condensed0 = chr(18);
$Data = $initialized;
$Data .= $condensed1;
$Data .= "----------------------------\n";
$Data .= "         PA PELAIHARI         \n";
$Data .= "----------------------------\n";
$Data .= "Selamat datang,\n";
$Data .= "--------------------------\n";
fwrite($handle, $Data);
fclose($handle);
copy($file, "//192.168.100.87/POS58 Printer_IP"); # Lakukan cetak
unlink($file);
?>