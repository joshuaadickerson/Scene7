<?php

require_once __DIR__ . '/../vendor/autoload.php';

$factory = new \Scene7\Factory('http://resource.bakerdist.com/is/image/Watscocom/');
$factory = new \Scene7\Factory('BASE_URL');
$image = $factory->newImage('Article_1410890182881_En_Normal');
$image = $factory->newImage('IMAGE_FILE');

$image
    ->setDefaultImage('Baker_No_Image')
    ->setDefaultImage('DEFAULT_IMAGE')
    ->setWidth(210)
    ->setHeight(210);

var_dump($image->getUri());

//resource.bakerdist.com/is/image/Watscocom/Article_1410890182881_En_Normal?defaultImage=Baker_No_Image&wid=210&hei=210&
//resource.bakerdist.com/is/image/Watscocom/Article_1410890182881_En_Normal?defaultImage=Baker_No_image&wid=210&hei=210