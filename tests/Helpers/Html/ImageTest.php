<?php

namespace Scene7\Helpers\Html;

use PHPUnit\Framework\TestCase;

final class ImageTest extends TestCase
{
    public function testBasicImageTag()
    {
        $this->assertEquals(new Image, '<img>');
    }

    public function testSettingAttributesWithConstructor()
    {
        $image = new Image(['foo' => 'bar']);
        $this->assertEquals($image->render(), '<img foo="bar">');
    }

    public function testImageHasId()
    {
        $image = new Image;
        $image->setId('myId');
        $this->assertEquals($image->render(), '<img id="myId">');
    }
}