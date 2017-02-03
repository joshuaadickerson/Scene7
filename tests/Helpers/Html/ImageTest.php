<?php

namespace Scene7\Helpers\Html;

use PHPUnit\Framework\TestCase;

final class ImageTest extends TestCase
{
    public function testBasicImageTag()
    {
        $this->assertEquals(new Image('foo', ''), '<img src="foo" alt="">');
    }

    public function testSettingAttributesWithConstructor()
    {
        $image = new Image('myImg.png', '', ['foo' => 'bar']);
        $this->assertEquals($image->render(), '<img src="myImg.png" alt="" foo="bar">');
    }

    public function testImageHasId()
    {
        $image = new Image('myImg.png', '');
        $image->setId('myId');
        $this->assertEquals($image->render(), '<img src="myImg.png" alt="" id="myId">');
    }
}