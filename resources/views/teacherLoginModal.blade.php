<?php

$data = array();
$counter = 0;
foreach($classes as $class)
{
    $data[$counter]['country'] = $class->name;
    $data[$counter]['visits'] = $class->students->count();
    $data[$counter]['color'] = "#FF2F00";
    $counter++;
}
header( 'Content-Type: application/json' );
echo json_encode($data)
?>