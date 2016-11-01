<?php
require __DIR__ . '/vendor/autoload.php';
use AlexaRank\AlexaRank;

$alexaRank = new AlexaRank();
$alexaRank->getRank('aparat.com');

$alexaRank->getMultipleRanks(['aparat.com','cloob.com']);