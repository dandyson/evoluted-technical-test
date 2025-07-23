<?php

use PHPUnit\Framework\TestCase;
use App\CardParser;
use App\PointsCalculator;

class PointsCalculatorTest extends TestCase {

    // TESTS TO WRITE:
        // Test an integer is returned
        // Test points calculation is correct
        // Errors: Test JsonFormat error shows if JSON format invalid

    public function test_correct_points_int_value_returned() {
        $file = __DIR__ . '/../Fixtures/test_input.txt';
        $outputFile = __DIR__ . '/../tmp/output_test.json';

        // Make sure tests start clean
        if (file_exists($outputFile)) {
            unlink($outputFile);
        }

        CardParser::parseCardsFromFile($file, $outputFile);

        $result = PointsCalculator::calculate($outputFile);

        $this->assertIsInt($result);
        $this->assertSame(13, $result);

        unlink($outputFile);
    }
}