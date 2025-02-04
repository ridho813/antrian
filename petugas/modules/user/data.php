<?php
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' )) {

    // nama table
    $table = 'sys_users';
    // Table's primary key
    $primaryKey = 'userID';

    $columns = array(
        array( 'db' => 'fullname', 'dt' => 1 ),
        array( 'db' => 'user_account_name', 'dt' => 2 ),
        array( 'db' => 'user_permissions', 'dt' => 3 ),
        array( 'db' => 'block_users', 'dt' => 4 ),
        array(
            'db' => 'last_login',
            'dt' => 5,
            'formatter' => function( $d, $row ) {
                if ($d!=Null) {
                    $last_login = date('d-m-Y H:i:s', strtotime($d));
                } else {
                    $last_login = "-";
                }
                return $last_login;
            }
        ),
        array( 'db' => 'userID', 'dt' => 6 )
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