<?php
require __DIR__ . '/vendor/autoload.php';
//$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
//$dotenv->load();

$bot_api_key  = isset($_ENV['BOT_API_KEY']) ? $_ENV['BOT_API_KEY'] : getenv('BOT_API_KEY');
$bot_username = isset($_ENV['BOT_USERNAME']) ? $_ENV['BOT_USERNAME']: getenv('BOT_USERNAME');
echo $bot_username . "55\n";
//$mysql_credentials = [
//    'host'     => 'localhost',
//    'port'     => 3306, // optional
//    'user'     => 'dbuser',
//    'password' => 'dbpass',
//    'database' => 'dbname',
//];

try {
    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);

    $telegram->useGetUpdatesWithoutDatabase();

    // Handle telegram getUpdates request
    $a = $telegram->handleGetUpdates();
    echo $a;
} catch (Exception $e) {
    // log telegram errors
    if ($e instanceof Longman\TelegramBot\Exception\TelegramException){
        echo "telegram exception\n";
    }
     echo $e->getMessage()."\n";

}

echo '<h1>Hello world</h1>';
