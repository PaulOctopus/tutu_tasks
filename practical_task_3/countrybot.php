<?php

include 'Telegram.php';

$bot_token = '554120614:AAFCVD86jnb_mac0rqZ-nFC2rCVz8nXkBr4';
$telegram = new Telegram($bot_token);

$country = $telegram->Text();
$chat_id = $telegram->ChatID();

if ($country > '') {
    $data = json_decode(
        file_get_contents(
            'https://restcountries.eu/rest/v2/name/'.$country
        )
    );
    $isoCode = $data['alpha2Code'];
    $content = [
        'chat_id' => $chat_id, 'text' => $isoCode ? ':'.$isoCode.':' : 'Не найдено'
    ];
    $telegram->sendMessage($content);
}
