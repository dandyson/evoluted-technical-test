<?php
namespace App;

use App\Utilities\FileHelper;
use RuntimeException;

class CardParser
{
    public $file;

    public static function parseCardsFromFile(string $file): string|array
    {
        $content = FileHelper::getFileContent($file);
        $lines = explode(PHP_EOL, trim($content));

        $result = [];

        foreach ($lines as $line) {

            // Ensure line format is valid
            if (!str_contains($line, ':') || !str_contains($line, '|')) {
                throw new RuntimeException("Invalid card format: $line");
            }
            // Card number
            if (!preg_match('/Card\s+(\d+)/', $line, $matches)) {
                throw new RuntimeException("Missing card number in: $line");
            }

            list($card, $numbers) = explode(':', $line);

            // Get card number
            preg_match('/Card\s+(\d+)/', $line, $matches);

            $card = (int) $matches[1];

            // split the numbers further into winning and yours
            list($winning, $yours) = explode('|', $numbers);

            // Need to trim and split numbers into ["39", "54"] etc
            $winning = array_map('intval', preg_split('/\s+/', trim($winning)));
            $yours = array_map('intval', preg_split('/\s+/', trim($yours)));

            array_push($result, [
                'card' => $card,
                'winning' => $winning,
                'yours' => $yours
            ]);
        }

        file_put_contents('files/output/output.json', json_encode($result, JSON_PRETTY_PRINT));

        return 'SUCCESS: Data successfully outputted to files/output/output.json';

    }
}

?>