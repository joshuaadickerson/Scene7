<?php

namespace Scene7\Requests;

use PHPUnit\Framework\TestCase;

final class ImageTest extends TestCase
{
    const BASE_URL = 'BASE_URL/';
    const IMAGE_FILE = 'IMAGE_FILE';
    const DEFAULT_IMAGE = 'DEFAULT_IMAGE';

    public function testFactoryCreatesNewImage()
    {
        $image = $this->getImage();
        $this->assertInstanceOf(\Scene7\Requests\Image::class, $image);
        $this->assertInstanceOf(\Scene7\Requests\AbstractRequest::class, $image);
    }

    public function testAlign()
    {
        $image = $this->getImage()->setAlign(0, -1);
        $this->assertContains('align=0,-1', $image->getUri());
    }

    public function testAnchor()
    {
        $image = $this->getImage();

        $image->setAnchor(0, 0);
        $this->assertContains('anchor=0,0', $image->getUri());

        $image->setAnchor(5, 5);
        $this->assertContains('anchor=5,5', $image->getUri());

        $image->setAnchor(0, 0, true);
        $this->assertContains('anchorN=0,0', $image->getUri());

        $image->setAnchor(-0.5, -0.5, true);
        $this->assertContains('anchorN=-0.5,-0.5', $image->getUri());
    }

    public function testBackgroundColor()
    {
        $image = $this->getImage()->setBackgroundColor('214,245,130');
        $this->assertContains('bgc=214,245,130', $image->getUri());
    }

    public function setTestEmbedColorProfileIs1()
    {
        $expected = 'iccEmbed=1';
        $image = $this->getImage();

        $tests = [true, 1, 'a'];
        foreach ($tests as $test) {
            $image->setEmbedColorProfile($test);
            $this->assertContains($expected, $image->getUri());
        }
    }

    public function setTestEmbedColorProfileIs0()
    {
        $expected = 'iccEmbed=0';
        $image = $this->getImage();

        $tests = [false, 0, '', null];
        foreach ($tests as $test) {
            $image->setEmbedColorProfile($test);
            $this->assertContains($expected, $image->getUri());
        }
    }

    public function testSetDefaultImage()
    {
        $image = $this->getImage()->setDefaultImage(self::DEFAULT_IMAGE);
        $this->assertContains('defaultImage=' . self::DEFAULT_IMAGE, $image->getUri());
    }

    public function testSetWidth()
    {
        $image = $this->getImage()->setWidth(210);
        $this->assertContains('wid=210', $image->getUri());
    }

    public function testSetWidthTooSmall()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->getImage()->setWidth(0);
    }

    public function testSetHeight()
    {
        $image = $this->getImage()->setHeight(210);
        $this->assertContains('hei=210', $image->getUri());
    }

    public function testSetHeighTooSmall()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->getImage()->setHeight(0);
    }

    public function testAddingHeightAndWidthReturnsFullImageUrl()
    {
        $image = $this->getImage()
            ->setDefaultImage(self::DEFAULT_IMAGE)
            ->setWidth(210)
            ->setHeight(210);

        $this->assertEquals('BASE_URL/IMAGE_FILE?defaultImage=DEFAULT_IMAGE&wid=210&hei=210', $image->getUri());
    }

    protected function getImage()
    {
        return new \Scene7\Requests\Image(self::BASE_URL, self::IMAGE_FILE);
    }
}