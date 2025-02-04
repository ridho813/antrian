<?php
session_start();
// hapus session
session_destroy();

// alihkan ke halaman login dan berikan alert = 2
header('Location: logout');
?>