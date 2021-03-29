<?php
require_once __DIR__ . '/vendor/autoload.php';
use Longman\TelegramBot\Request;
use Longman\TelegramBot\Entities\Update;
//$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
//$dotenv->load();

$bot_api_key  = isset($_ENV['BOT_API_KEY']) ? $_ENV['BOT_API_KEY'] : getenv('BOT_API_KEY');
$bot_username = isset($_ENV['BOT_USERNAME']) ? $_ENV['BOT_USERNAME']: getenv('BOT_USERNAME');
//$mysql_credentials = [
//    'host'     => 'localhost',
//    'port'     => 3306, // optional
//    'user'     => 'dbuser',
//    'password' => 'dbpass',
//    'database' => 'dbname',
//];

$getDollarApiPath = 'https://api.accessban.com/v1/data/sana/json';

try {
    $path = "https://api.telegram.org/bot$bot_api_key";

    $update = json_decode(file_get_contents("php://input"), TRUE);
    $chatId = $update["message"]["chat"]["id"];
    $message = $update["message"]["text"];
    if ($message === 'دلار'){
        $jsonData = file_get_contents('https://api.accessban.com/v1/data/sana/json');
        $jsonData = json_decode($jsonData);
        $dollarPrice = number_format($jsonData->sana->data[0]->p);
        $text = "قیمت دلار امروز $dollarPrice ریال ";
    }else{
        $text = 'بنویس دلار تا بهت قیمت دلار رو به ریال بگم!';
    }
    file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=$text");
//    if (strpos($message, "/weather") === 0) {
//        $location = substr($message, 9);
//        $weather = json_decode(file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".$location."&appid=mytoken"), TRUE)["weather"][0]["main"];
//        file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=Here's the weather in ".$location.": ". $weather);
//    }

//    $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);
//
//    $telegram->enableLimiter();
//    print "sdf\n";
//    print "sdf\n";
//    print "sdf\n";
//    echo "sdf\n";
//    if (Request::getInput()){
//        $post = json_decode(Request::getInput(), true);
//
//
//        $oUpdate = new Update($post, $bot_username);
//        $oMessage = $oUpdate->getMessage();
//
//
//        $sText = $oMessage->getText();
//        echo $sText;
//        print "sdf\n";
//        print "sdf\n";
//        print "sdf\n";
//    }else{
//        echo "request nadarim\n";
//    }
//    if (strpos($sText, '@'.$yourUsername) !== false
//        || (isset($post['reply_to_message'])
//            && $post['reply_to_message']['from']['username'] == $yourUsername)) {
//        $data = [];
//        $data['chat_id'] = $yourChatId;
//        $data['text'] = 'Neue Nachricht in: '.$oMessage->getChat()->getTitle()."\n\nVon: @".$oMessage->getFrom()->getUsername()." (".$oMessage->getFrom()->getFirstName().")\nNachricht:\n".$sText;
//        return Request::sendMessage($data);
//    }
//    return Request::emptyResponse();

}
//try {
//    // Create Telegram API object
//    $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);
//$telegram->enableLimiter();
//    $telegram->useGetUpdatesWithoutDatabase();
//
//    // Handle telegram getUpdates request
//    $a = $telegram->handleGetUpdates();
//    echo $a;
//}
catch (Exception $e) {
    // log telegram errors
    if ($e instanceof Longman\TelegramBot\Exception\TelegramException){
        echo "telegram exception\n";
    }
     echo $e->getMessage()."\n";

}

echo '<h1>Hello world</h1>';
