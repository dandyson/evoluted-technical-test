<?php
require __DIR__ . '/../vendor/autoload.php';

use App\PointsCalculator;

var_dump(PointsCalculator::calculate('files/output/output.json'));

?>