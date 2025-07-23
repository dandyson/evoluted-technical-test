<?php
require __DIR__ . '/../vendor/autoload.php';

use App\CardParser;

echo CardParser::parseCardsFromFile('files/input.txt');

?>