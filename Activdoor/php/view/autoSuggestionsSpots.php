<?php

$json = array();

while($data = $spots->fetch()){
    //var_dump($data);

    $spot = new Spot($data['idSpot'],
        $data['nom'],$data['description'],
        $data['latitude'], $data['longitude'],
        $data['ville'],$data['pays'], $data['type']);

    array_push($json, (array) $spot);
}

echo json_encode($json);