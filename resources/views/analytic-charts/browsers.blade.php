<?php

$data = array();
$counter = 0;
foreach($analyticsData as $item)
{
    $data[$counter]['country'] = $item['browser'];
    $data[$counter]['visits'] = $item['sessions'];
    $counter++;
}
header( 'Content-Type: application/json' );
echo json_encode($data)
?>

