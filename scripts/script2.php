<?php
require __DIR__ . '/../vendor/autoload.php';

use App\PointsCalculator;

echo PointsCalculator::calculate('files/output/output.json');

?>