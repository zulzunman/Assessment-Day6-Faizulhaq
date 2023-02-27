<?php



// DB table to use
$table = 'authors';

// Table's primary key
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array('db' => 'first_name', 'dt' => 0),
    array('db' => 'last_name',  'dt' => 1),
    array('db' => 'email',   'dt' => 2),
    array(
        'db'        => 'birthdate',
        'dt'        => 3,
        'formatter' => function ($d, $row) {
            return date('jS M y', strtotime($d));
        }
    ),
    array(
        'db'        => 'added',
        'dt'        => 4,
        'formatter' => function ($d, $row) {
            return ($d == 1) ? 'Active' : 'Inactive';
        }
    )
);

// SQL server connection information
$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'dat_table',
    'host' => 'localhost'
    // ,'charset' => 'utf8' // Depending on your PHP and MySQL config, you may need this
);


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

require ('ssp.class.php');

echo json_encode(
    SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
);
