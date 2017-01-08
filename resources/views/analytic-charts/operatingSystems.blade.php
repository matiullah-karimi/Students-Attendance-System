<?php

$data = array();
$counter = 0;
foreach($analyticsData as $item)
{
    $data[$counter]['title'] = $item[0];
    $data[$counter]['value'] = $item[1];
    $counter++;
}
header( 'Content-Type: application/json' );
echo json_encode($data)
?>

