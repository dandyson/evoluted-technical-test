<?php

use App\Utilities\FileHelper;
use PHPUnit\Framework\TestCase; 
use App\CardParser;

class CardParserTest extends TestCase {

    // TESTS TO WRITE:
        // Test it outputs file and return string happens 
        // Errors: Test lines are valid
        // Errors: Test card number exists
        
    public function test_valid_JSON_file_is_generated_and_success_string_returned() {
        $file = __DIR__ . '/../Fixtures/test_input.txt';
        $outputFile = __DIR__ . '/../tmp/output_test.json';

        // Make sure tests start clean
        if (file_exists($outputFile)) {
            unlink($outputFile);
        }

        $result = CardParser::parseCardsFromFile($file, $outputFile);

        $this->assertStringContainsString('SUCCESS', $result);
        $this->assertFileExists($outputFile);

        $json = file_get_contents($outputFile);
        $this->assertNotFalse($json);
        $this->assertIsArray(json_decode($json, true));

        unlink($outputFile);
    }

    public function test_runtimeException_occurs_with_invalid_lines() {
        $file = __DIR__ . '/../Fixtures/test_invalid_line.txt';
        $outputFile = __DIR__ . '/../tmp/output_test.json';

        // Make sure tests start clean
        if (file_exists($outputFile)) {
            unlink($outputFile);
        }

        $this->expectException(RuntimeException::class);

        CardParser::parseCardsFromFile($file, $outputFile);
    }

    public function test_runtimeException_occurs_with_missing_card_number() {
        $file = __DIR__ . '/../Fixtures/test_missing_card_number.txt';
        $outputFile = __DIR__ . '/../tmp/output_test.json';

        // Make sure tests start clean
        if (file_exists($outputFile)) {
            unlink($outputFile);
        }

        $this->expectException(RuntimeException::class);

        CardParser::parseCardsFromFile($file, $outputFile);
    }
}