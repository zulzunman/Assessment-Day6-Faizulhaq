<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$database = [
    [ 'Tree',  'Height', 'Age', 'Yield', 'Profit' ],
    [ 'Apple',  18,       20,    14,      105.00  ],
    [ 'Pear',   12,       12,    10,       96.00  ],
    [ 'Cherry', 13,       14,     9,      105.00  ],
    [ 'Apple',  14,       15,    10,       75.00  ],
    [ 'Pear',    9,        8,     8,       76.80  ],
    [ 'Apple',   8,        9,     6,       45.00  ],
];

$sheet->fromArray( $database);

$writer = new Xlsx($spreadsheet);
$writer->save('array.xlsx');

?>