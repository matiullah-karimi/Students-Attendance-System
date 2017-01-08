<?php

$data = array();
$counter = 0;
foreach($analyticsData as $item)
{
    $data[$counter]['country'] = $item[0];
    $data[$counter]['visits'] = $item[1];
    $data[$counter]['color'] = "#FF2F00";
    $counter++;
}
header( 'Content-Type: application/json' );
echo json_encode($data)
?>

