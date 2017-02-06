<?php

require_once __DIR__ . '/../vendor/autoload.php';

$factory = new \Scene7\Factory('https://www.example.com');

$image = $factory->newImage('myProduct');

$layer = $image->setWidth(200)->setHeight(100)->newLayer();
$layer->setColor('gray');

$layer = $image->newLayer();
$layer->setFlip('lr')->setBrightness(5);

var_dump($image->render());