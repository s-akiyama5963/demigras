<?php

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputOption;

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

// コマンド追加
$app->addCommands([
]);


// 実行
$app->run();
