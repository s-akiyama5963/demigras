<?php

use Dotenv\Dotenv;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\ConsoleEvents;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Event\ConsoleCommandEvent;
use Symfony\Component\EventDispatcher\EventDispatcher;

// Setup
require_once(realpath(__DIR__.'/../resource/constants.php'));
require_once(realpath(__DIR__.'/../vendor/autoload.php'));

$app = new Application('Demigras', DEMIGRAS_VERSION);
$app->setVersion(DEMIGRAS_VERSION);


// 共通オプション追加
$options = [];
$definition = $app->getDefinition();

$options[] = new InputOption(
    '--config',
    null,
    InputOption::VALUE_REQUIRED,
    '設定ファイルの場所を指定する。',
    '.env',
);

$definition->addOptions($options);
$app->setDefinition($definition);


// 共通処理定義
$dispatcher = new EventDispatcher();

$dispatcher->addListener(ConsoleEvents::COMMAND, function(ConsoleCommandEvent $event) : void
{
    $input = $event->getInput();

    // 環境変数設定
    $dotenvPath = $input->getOption('config');
    $dotenvName = null;

    if($dotenvPath === null)
    {
        $dotenvPath = getcwd();
    }
    else
    {
        $dotenvPathPart = pathinfo($dotenvPath);
        $dotenvPath = $dotenvPathPart['dirname'];
        $dotenvName = $dotenvPathPart['basename'];
    }

    $dotenv = Dotenv::createImmutable($dotenvPath, $dotenvName);
    $dotenv->load();
});

$app->setDispatcher($dispatcher);


// コマンド追加
$app->addCommands([
]);


// 実行
$app->run();
