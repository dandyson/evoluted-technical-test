<?php
namespace App;

use Error;

class PointsCalculator
{
    public $file;

    public static function getFileContent(string $file): string|Error
    {
        $content = file_get_contents($file);

        if ($content === false) {
            throw new \RuntimeException("Cannot read file: $file");
        }

        if (trim($content) === '') {
            throw new \RuntimeException("File is empty: $file");
        }

        return $content;
    }

    public static function calculate(string $file): int|Error
    {
        try {
            $jsonContent = json_decode(PointsCalculator::getFileContent($file));

            $totalPoints = 0;

            foreach ($jsonContent as $value) {

                $cardPoints = 0;
                foreach ($value->yours as $yourNumber) {
                    if (in_array($yourNumber, $value->winning)) {
                        $cardPoints == 0 ? $cardPoints += 1 : $cardPoints *= 2;
                    }
                }

                $totalPoints += $cardPoints;
            }

            return $totalPoints;
            
        } catch (Error $error) {
            return $error;
        }

    }
}

?>