<?php
//install this to manage .env variable and autolad function in composer>> composer require vlucas/phpdotenv 
//install this to manage api petisions>> composer require guzzlehttp/guzzle

require 'vendor/autoload.php';

use Dotenv\Dotenv;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

//load token from .env file
$accessToken = $_ENV['TMDB_TOKEN'];

function showMovies(string $category, string $accessToken){
    
    //array with all the options 
    $endpoints = [
        'playing' => 'now_playing',
        'top' => 'top_rated',
        'popular'=> 'popular',
        'upcoming' => 'upcoming'
    ];

    if(!isset($endpoints[$category])){
        echo "\n " . $category . "is not a valid option! ⚠️⚠️⚠️ \n";
        //implode() combines all the array values but looses all the key info:
        echo "✔️ Choose one of this:  " . implode(", ", array_keys($endpoints)) . "\n\n";
        exit(1);

    }
    
    $client = new Client(['base_uri' => 'https://api.themoviedb.org/3/']);

    try {
        $response = $client->request('GET', "movie/{$endpoints[$category]}",[
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'accept' => 'application/json',
            ],
            'query' => ['language' => 'en-US', 'page' => 1]
        ]);
        $data = json_decode($response->getBody(), true);

        echo "\n🎬 --- Movies: " . strtoupper($category) . " --- 🎬\n";

        foreach($data['results'] as $movie){
            echo "⭐ {$movie['title']} ({$movie['release_date']})\n";
        }


    }catch(GuzzleException $e){
        echo "ERROR: " . $e->getMessage() . "\n";
    }
}

$options = getopt("", ["type:"]);

if(isset($options['type'])){
    showMovies($options['type'], $accessToken);
}else{
    echo "Usage: php movie.php --type [playing|popular|top|upcoming]\n\n";
}



?>
