<?php
namespace App;

use Error;

class CardParser
{
    public $file;

    public static function getFile(string $file): bool|Error|string
    {
        try {
            return file_get_contents($file);
        } catch (Error $error) {
            return $error;
        }

    }

    public static function parseCardsFromFile(string $file): bool|Error|string
    {
        try {
            $contentJSON = json_encode(CardParser::getFile($file));
            return $contentJSON;
        } catch (Error $error) {
            return $error;
        }

    }
}

?>