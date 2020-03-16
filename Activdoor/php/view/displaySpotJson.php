<?php

$json = array();

while($data = $spots->fetch()){
    array_push($json, $data);
}

echo json_encode($json);
