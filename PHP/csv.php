<?php

//open database connection
try {
    $db = new PDO('mysql:host=localhost;dbname=store;charset=utf8',
                    'root',
                    '');

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
}
catch(PDOException $ex) {
    echo "did not connect...";
}

header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=products.csv');

$sql = "SELECT * FROM products;";

$sth = $db->prepare($sql);
$sth->execute();

$filename = date('d.m.Y').'.csv';

$data = fopen($filename, 'w');

while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
    $csv = implode(',', $row) . "\n";
    fwrite($data, $csv);
    print_r($csv);
}

echo "\r\n";

fclose($data);