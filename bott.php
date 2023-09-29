<?php
use Discord\Discord;
use Discord\WebSockets\Event;
use Discord\WebSockets\Intents;

require_once('./vendor/autoload.php');
require_once('./key.php');

$key = getKey();
$discord = new Discord(['token' => $key]);

$discord->on('ready', function (Discord $discord) {
    echo 'Bot is ready';
});

$discord->on('message', function ($message, $discord) {
    $content = $message -> content;
    if(strpos($content, '!') === false) return;

    if($content === '!joke') {
        //get joke from api
        $client = new \GuzzleHttp\Client();
        $response = $client ->request('GET', 'https://api.chucknorris.io/jokes/random');
      $joke = json_decode($response -> getBody());
      $joke = $joke->value;
      $message->reply($joke); 
        //reply

    }
    });


$discord->run();
