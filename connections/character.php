<?php
    if (isset($_GET['character-id'])) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    
        $character_ID = htmlentities(strtolower($_GET['character-id'])); 

        $ts = time();
        $public_key = '90814ea2f3d43967798aa37a32e622b4';
        $private_key = 'bfe31c44a9e2d4513c780a0ccd7dccf3edcea96b';
        $hash = md5($ts . $private_key . $public_key);

        $query = array(
            'format' => 'comic',
            'formatType' => 'comic',
            'orderBy' => 'title',
            'apikey' => $public_key,
            'ts' => $ts,
            'hash' => $hash,

        );

        // https://gateway.marvel.com:443/v1/public/characters/1009368/comics?format=comic&formatType=comic&orderBy=title&apikey=90814ea2f3d43967798aa37a32e622b4

        $marvel_url = 'https://gateway.marvel.com:443/v1/public/characters/' . $character_ID . "/comics" . "?" . http_build_query($query);
       
        curl_setopt($curl, CURLOPT_URL, $marvel_url);

        $result = json_decode(curl_exec($curl), true);
        curl_close($curl);
        echo json_encode($result);

    } else {
        echo "Error from character.php";
    }



 ?>   



