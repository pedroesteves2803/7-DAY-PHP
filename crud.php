<?php 

function crud_create($user){
    $data = file_get_contents(DATA_LOCATION);
    $data = json_decode($data);
    $data[] = $user;

    file_put_contents(DATA_LOCATION, json_encode($data));
}

function crud_restore($user){
    $data = file_get_contents(DATA_LOCATION);
    $data = json_decode($data);

    foreach ($data as $item) {
        if($item->email === $user){
            return $item;
        };
    }
    
    return false;
}