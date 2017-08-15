<?php
require_once __DIR__ . '/../vendor/autoload.php';

$image = new Stryv\WheelImage([
    'Health & Fitness' => ['#f8c33e', rand(0, 100)],
    'Fun & Recreation' => ['#f2953a', rand(0, 100)],
    'Environment' => ['#97c54d', rand(0, 100)],
    'Community' => ['#7AA344', rand(0, 100)],
    'Family & Friends' => ['#2281c2', rand(0, 100)],
    'Partners & Love' => ['#1b64a9', rand(0, 100)],
    'Growth & Learning' => ['#883e90', rand(0, 100)],
    'Spirituality' => ['#a13496', rand(0, 100)],
    'Money & Finance' => ['#cd2d31', rand(0, 100)],
    'Career & Mission' => ['#e25d34', rand(0, 100)],
]);

$writer = new Stryv\Writing\SVGWriter();
$writer->writeNode($image->getDocument());

header('Content-Type: image/svg+xml');
?>
<?xml version="1.0" encoding="utf-8"?>
<?= $writer->getString() ?>
