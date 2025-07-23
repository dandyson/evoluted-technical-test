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

    public static function parseCardsFromFile(string $file): array|string|Error
    {
        $result = [];

        try {
            $content = CardParser::getFile($file);

            $lines = explode(PHP_EOL, trim($content));

            foreach($lines as $line) {

                list($card, $numbers) = explode(':', $line);

                // Get card number
                preg_match('/Card\s+(\d+)/', $line, $matches);

                $card = (int) $matches[1];
            
                // split the numbers further into winning and yours
                list($winning, $yours) = explode('|', $numbers);

                // Need to trim and split numbers into ["39", "54"] etc
                $winning = array_map('intval', preg_split('/\s+/', trim($winning)));
                $yours =  array_map('intval', preg_split('/\s+/', trim($yours)));
                
                array_push($result, [
                    'Card' => $card,
                    'Winning' => $winning,
                    'Yours' => $yours
                ]);
            }

            file_put_contents('files/output/output.json', json_encode($result, JSON_PRETTY_PRINT));

            return 'SUCCESS: Data successfully outputted to files/output/output.json';
            
        } catch (Error $error) {
            return $error;
        }

    }
}

?>