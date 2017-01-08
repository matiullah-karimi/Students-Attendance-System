<?php

$colors =    [ "#FF0F00",
        "#FF6600",
        "#FF9E01",
        "#FCD202",
        "#F8FF01",
        "#B0DE09",
        "#04D215",
        "#0D52D1",
        "#2A0CD0",
        "#8A0CCF",
        "#CD0D74",
        "#754DEB",
        "#333333"
];

$data = array();
$counter = 0;
foreach($analyticsData as $item)
{
    $data[$counter]['country'] = $item['url'];
    $data[$counter]['visits'] = $item['pageViews'];
    $data[$counter]['color'] = $colors[$counter];
    $counter++;
}
header( 'Content-Type: application/json' );
echo json_encode($data)
?>

