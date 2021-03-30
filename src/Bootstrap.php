<?php declare(strict_types = 1);

namespace Myframeworkless;

require __DIR__ . '/../vendor/autoload.php';

error_reporting(E_ALL);

// When pushed to the production server change the line below to "production".
$environment = 'development';

/**
* Register the error handler
*/
$whoops = new \Whoops\Run;
if ($environment !== 'production') {
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
} else {
    $whoops->pushHandler(function($e){
        echo 'Todo: Friendly error page and send an email to the developer';
    });
}
$whoops->register();

$request = new \Http\HttpRequest($_GET, $_POST, $_COOKIE, $_FILES, $_SERVER);
$response = new \Http\HttpResponse;

$content = '<p>This is a set response using the HTML handler package from Mr. Patrick Louey.</p>';
$response->setContent($content);

foreach ($response->getHeaders() as $header) {
    header($header, false);
}

echo $response->getContent();
