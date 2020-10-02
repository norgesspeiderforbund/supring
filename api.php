<?php

header('Content-Type: application/json');
if($_GET['func'] == 'read') {
    echo file_get_contents('vis.json');
    file_put_contents('vis.json', json_encode(['ny' => false]));
    exit;
}
if($_GET['func'] != 'write'){
    die(json_encode("Hva skal jeg?!"));
}


$delegatnr = $_GET['delegatnr'];

$alle_delegater = file_get_contents('delegater.csv');
$alle_delegater = explode("\n", $alle_delegater);

foreach($alle_delegater as $delegat){
    $info = explode(';', $delegat);
    if($info[0] == $delegatnr){
        file_put_contents('vis.json', json_encode(['ny' => true, 'navn' => $info[1], 'krets' => $info[2]]));
        die(json_encode(true));
    }
}

echo json_encode(false);