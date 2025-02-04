<?php
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' )) {
    // nama table
    $table = 'sys_database';
    // Table's primary key
    $primaryKey = 'dbID';

    $columns = array(
        array( 'db' => 'file_name', 'dt' => 1 ),
        array(
            'db' => 'created_date',
            'dt' => 2,
            'formatter' => function( $d, $row ) {
                return date('d-m-Y H:i:s', strtotime($d));
            }
        ),
        array( 'db' => 'file_size', 'dt' => 3 ),
        array( 'db' => 'dbID', 'dt' => 4 )
    );

    // SQL server connection information
    require_once "../../../config/database.php";
    // ssp class
    require '../../assets/vendors/js/datatables/ssp.class.php';

    echo json_encode(
        SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
    );
} else {
    echo '<script>window.location="../../error-404.html"</script>';
}
?>