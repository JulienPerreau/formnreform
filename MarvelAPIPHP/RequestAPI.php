<?php

//default request marvel api
function MarvelApiRequestChar($PRIVATE_KEY, $PUBLIC_KEY,  $offset = 100, $limit = 20){

    // To create a new TimeStamp
    $date = new DateTime();
    $timestamp = $date->getTimestamp();


    $keys = $PRIVATE_KEY.$PUBLIC_KEY;

    $string = $timestamp.$keys;

    $md5 = hash('md5', $string);

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://gateway.marvel.com:443/v1/public/characters?limit=$limit&offset=$offset&ts=$timestamp&apikey=$PUBLIC_KEY&hash=$md5");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json')                                                                       
    );   

    $output = curl_exec($ch) or die(curl_error()); 

    $data = str_replace('\\/', '/', $output);

    $body = json_decode($data, true);


    $array_char = $body['data']['results'];

    curl_close($ch);
    
    return $array_char;
}

function MarvelApiRequestFavorisChar($PRIVATE_KEY, $PUBLIC_KEY, $id){
    
    $date = new DateTime();
    $timestamp = $date->getTimestamp();


    $keys = $PRIVATE_KEY.$PUBLIC_KEY;

    $string = $timestamp.$keys;

    $md5 = hash('md5', $string);

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://gateway.marvel.com:443/v1/public/characters/$id?ts=$timestamp&apikey=$PUBLIC_KEY&hash=$md5");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json')                                                                       
    );   

    $output = curl_exec($ch) or die(curl_error()); 

    $data = str_replace('\\/', '/', $output);

    $body = json_decode($data, true);

    $array_char = $body['data']['results'];

    curl_close($ch);
    
    return $array_char;
}