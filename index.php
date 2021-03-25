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

try {

    $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);

    $telegram->enableLimiter();

    if (Request::getInput()){
        $post = json_decode(Request::getInput(), true);


        $oUpdate = new Update($post, $bot_username);
        $oMessage = $oUpdate->getMessage();


        $sText = $oMessage->getText();
        echo $sText;
    }else{
        echo "request nadarim\n";
    }
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
