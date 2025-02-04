<?php
// jika halaman konten yang dipilih beranda, panggil file view beranda
if ($_GET['page']=='beranda') {
	include "pages/beranda/view.php";
}
?>