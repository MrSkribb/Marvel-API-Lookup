<?php
    if (isset($_GET['character-id'])) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    
        $character_ID = htmlentities(strtolower($_GET['character-id'])); 

        $ts = time();
        $public_key = 'REDACTED';
        $private_key = 'REDACTED';
        $hash = md5($ts . $private_key . $public_key);

        $query = array(
            'format' => 'comic',
            'formatType' => 'comic',
            'orderBy' => 'title',
            'apikey' => $public_key,
            'ts' => $ts,
            'hash' => $hash,

        );

        

        $marvel_url = 'https://gateway.marvel.com:443/v1/public/characters/' . $character_ID . "/comics" . "?" . http_build_query($query);
       
        curl_setopt($curl, CURLOPT_URL, $marvel_url);

        $result = json_decode(curl_exec($curl), true);
        curl_close($curl);
        echo json_encode($result);

    } else {
        echo "Error from character.php";
    }



 ?>   



