<?php

use Symfony\Component\Console\Application;

// Setup
require_once(realpath(__DIR__.'/../resource/constants.php'));
require_once(realpath(__DIR__.'/../vendor/autoload.php'));

$app = new Application('Demigras', DEMIGRAS_VERSION);


// コマンド追加
$app->addCommands([
]);


// 実行
$app->run();
