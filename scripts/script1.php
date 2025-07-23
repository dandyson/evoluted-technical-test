<?php
require __DIR__ . '/../vendor/autoload.php';

use App\CardParser;

var_dump(CardParser::parseCardsFromFile('files/input.txt'));

?>