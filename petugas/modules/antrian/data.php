<?php
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' )) {
    session_start();

    $hari_ini = gmdate("Y-m-d", time()+60*60*7);
	$loket    = $_SESSION['antrian_user_permissions'];
    
    // nama table
    $table = 'antrian';
    // Table's primary key
    $primaryKey = 'ID';

    $columns = array(
        array( 'db' => 'no_antrian', 'dt' => 0 ),
        array( 'db' => 'panggil', 'dt' => 1 ),
        array( 'db' => 'loket', 'dt' => 2 ),
        array( 'db' => 'status', 'dt' => 3 ),
        array( 'db' => 'ID', 'dt' => 4 )
    );

    // SQL server connection information
    require_once "../../../config/database.php";
    // ssp class
    require '../../assets/vendors/js/datatables/ssp.class.php';

    echo json_encode(
        SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, null, "tanggal='$hari_ini' AND loket='$loket'" )
    );
} else {
    echo '<script>window.location="../../error-404.html"</script>';
}
?>