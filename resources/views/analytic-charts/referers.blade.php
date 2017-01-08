<?php

$data = array();
$counter = 0;
foreach($analyticsData as $item)
{
    $data[$counter]['country'] = $item['url'];
    $data[$counter]['visits'] = $item['pageViews'];
    $data[$counter]['color'] = "#FF2F00";
    $counter++;
}
header( 'Content-Type: application/json' );
echo json_encode($data)
?>

