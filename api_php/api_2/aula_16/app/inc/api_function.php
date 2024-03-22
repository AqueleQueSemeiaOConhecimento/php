<?php

function api_request($endpoint, $method = 'GET', $variables = []){

    // initiate the curl client
    $client = curl_init();

    // return the result as a string
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

    // define the url
    $url = API_BASE_URL;

    // if request is GET
    if($method == 'GET'){
        $url .= "?endpoint=$endpoint";

        // se variables nao forem vazio vai ser adicionado ela na url
        if(!empty($variables)){
            $url .= "&" . http_build_query($variables);
        }
    }


    // if request is POST

    if($method == 'POST'){
        $variables = array_merge(['endpoint' => $endpoint], $variables);
        curl_setopt($client, CURLOPT_POSTFIELDS, $variables);
    }

    curl_setopt($client, CURLOPT_URL, $url);

    $response = curl_exec($client);
    return json_decode($response, true);

}