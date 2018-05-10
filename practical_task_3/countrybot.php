<?php

include 'vendor/autoload.php';

$bot_token = '554120614:AAFCVD86jnb_mac0rqZ-nFC2rCVz8nXkBr4';
$telegram = new Telegram($bot_token);

class CountryBot
{
    const WIKI_API = 'https://ru.wikipedia.org/w/api.php?action=query&format=json&list=search&srsearch=';
    const G_MAPS_CODE = 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyDB6bgsOZd9KNSMMtzutM078vFiTpfcGlA&address=';

    /**@var Telegram*/
    private $bot;

    public function __construct(Telegram $telegram)
    {
        $this->bot = $telegram;
    }

    public function handle()
    {
        $text = $this->bot->Text();
        $content = [
            'chat_id' => $this->bot->ChatID()
        ];
        if($text == '/start'){
            $content['text'] = 'Пришлите название страны и я верну вам ее флаг и ссылку на информацию о ней';
            $this->bot->sendMessage($content);
        }
        elseif($text > ''){
            $countryCode = $this->getCountryCode($text);
            if($countryCode){
                if($emoji = $this->getFlagEmoji($countryCode)){
                    $content['text'] = $emoji;
                    $this->bot->sendMessage($content);
                }
                if($wikiPage = $this->getWikiPage($text)){
                    $content['text'] = $wikiPage;
                    $this->bot->sendMessage($content);
                }
            }
            else{
                $content['text'] = 'Страна не найдена';
                $this->bot->sendMessage($content);
            }
        }
    }

    private function getCountryCode($countryName)
    {
        $result = json_decode(
            file_get_contents(
                self::G_MAPS_CODE.$countryName
            ),1
        );
        $code = null;
        $addressData = $result['results'][0]['address_components'][0];
        if(in_array('country', $addressData['types'])){
            $code = $result['results'][0]['address_components'][0]['short_name'];
        }
        return $code ? strtolower($code) : null;
    }

    private function getFlagEmoji($countryCode)
    {
        if($countryCode){
            $emojiPack = json_decode(
                file_get_contents('emoji.json'),
                1
            );
            return $emojiPack[$countryCode];
        }
        return null;
    }

    private function getWikiPage($countryName)
    {
        $data = json_decode(
            file_get_contents(self::WIKI_API.$countryName),
            1
        );
        $title = $data['query']['search'][0]['title'];
        return $title ? 'https://ru.m.wikipedia.org/wiki/'.$title : null;
    }
}


$countryBot = new CountryBot($telegram);
$countryBot->handle();