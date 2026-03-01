<?php

//FUNCTION TO FECHT FEOM SCRATH THE ACESS TOKEN FROM THE .ENV FILE 
function loadEnv($path) {
    if (!file_exists($path)) return;
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue; // Ignorar comentarios
        list($name, $value) = explode('=', $line, 2);
        $_ENV[trim($name)] = trim($value);
    }
}

loadEnv(__DIR__ . '/.env');

$accessToken = $_ENV['TMDB_TOKEN'];


function getNowPlaying($accessToken){  
    $urlMovie = 'https://api.themoviedb.org/3/movie/now_playing';
    $ch = curl_init($urlMovie);

    curl_setopt_array($ch, array(
        CURLOPT_RETURNTRANSFER =>true,
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer ' . $accessToken, 
            'Content-Type: application/json'
        ),
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_FAILONERROR =>true,
    ));
    $response = curl_exec($ch); 
    if(curl_errno($ch)){
        $error_msg = curl_error($ch);
    }
    curl_close($ch);
    $data = json_decode($response, true);
    if (isset($data['results'])) {
        $movies = $data['results'];
        echo "\n --- Movies Now playing --- \n";
        foreach ($movies as $movie) {
            echo "🎬 Title: " . $movie['title'] . " | Release: " . $movie['release_date'] . "\n";
        }
    } else {
        echo "Nothing to see -> " . $error_msg . "\n";
    }
}

//-------------------------------------------------------------------------------------------------------

function getPopular($accessToken){  
    $urlMovie = 'https://api.themoviedb.org/3/movie/popular';
    $ch = curl_init($urlMovie);

    curl_setopt_array($ch, array(
        CURLOPT_RETURNTRANSFER =>true,
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer ' . $accessToken, 
            'Content-Type: application/json'
        ),
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_FAILONERROR => true,
    ));
    $response = curl_exec($ch);  
    if(curl_errno($ch)){
        $error_msg = curl_error($ch);
    }
    curl_close($ch);
    $data = json_decode($response, true);
    if (isset($data['results'])) {
        $movies = $data['results'];
        echo "\n --- Popular movies --- \n";
        foreach ($movies as $movie) {
            echo "🎬 Title: " . $movie['title'] . " | Release: " . $movie['release_date'] . "\n";
        }
    } else {
        echo "Nothing to see -> " . $error_msg . "\n";
    }
}

//-------------------------------------------------------------------------------------------------------

function getTopRated($accessToken){  
    $urlMovie = 'https://api.themoviedb.org/3/movie/top_rated';
    $ch = curl_init($urlMovie);

    curl_setopt_array($ch, array(
        CURLOPT_RETURNTRANSFER =>true,
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer ' . $accessToken, 
            'Content-Type: application/json'
        ),
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_FAILONERROR => true,
    ));
    $response = curl_exec($ch);
    if(curl_errno($ch)){
        $error_msg = curl_error($ch);
    }
    curl_close($ch);
    $data = json_decode($response, true);
    if (isset($data['results'])) {
        $movies = $data['results'];
        echo "\n --- Movies Top Rated --- \n";
        foreach ($movies as $movie) {
            echo "🎬 Title: " . $movie['title'] . " | Release: " . $movie['release_date'] . "\n";
        }
    } else {
        echo "Nothing to see -> " . $error_msg . "\n";
    }
}

//-------------------------------------------------------------------------------------------------------

function getUpcoming($accessToken){  
    $urlMovie = 'https://api.themoviedb.org/3/movie/upcoming';
    $ch = curl_init($urlMovie);

    curl_setopt_array($ch, array(
        CURLOPT_RETURNTRANSFER =>true,
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer ' . $accessToken, 
            'Content-Type: application/json'
        ),
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_FAILONERROR => true,
    ));
    $response = curl_exec($ch);  
    if(curl_errno($ch)){
        $error_msg = curl_error($ch);
    }
    curl_close($ch);
    $data = json_decode($response, true);
    if (isset($data['results'])) {
        $movies = $data['results'];
        echo "\n --- Movies Upcoming --- \n";
        foreach ($movies as $movie) {
            echo "🎬 Title: " . $movie['title'] . " | Release: " . $movie['release_date'] . "\n";
        }
    } else {
        echo "Nothing to see -> " . $error_msg . "\n";
    }
}

//-------------------------------------------------------------------------------------------------------

echo "\n --------------------- \n MovieApp \n ---------------------";
echo "\n app --type playing \n app --type popular \n app --type top \n app --type upcoming \n --------------------- \n";

$userInput = "";
while($userInput!="none"){
    $userInput = readline("Please enter an option above or 'none' to leave: ");
    $option = strtolower(trim($userInput));

    if($option==="playing"){
        getNowPlaying($accessToken);
    }else if($option==="popular"){
        getPopular($accessToken);
    }else if($option==="top"){
        getTopRated($accessToken);
    }else if($option==="upcoming"){
        getUpcoming($accessToken);
    }else if($option==="none"){ 
        echo "Thanks for using this app. Bye! \n";
        break;
    }else{ 
        echo "Error on selections \n";
    }
}

?>