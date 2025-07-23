<?php

namespace App;

use App\Utilities\FileHelper;
use RuntimeException;

class PointsCalculator
{
    public $file;

    public static function calculate(string $file): int|array
    {
        $content = FileHelper::getFileContent($file);
        
        // First, check if valid JSON
        if (!json_validate($content)) {
            throw new RuntimeException("Invalid JSON Format");
        }

        $jsonContent = json_decode($content);
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
            
        }
    }

?>