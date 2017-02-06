<?php

namespace Scene7\Helpers\Html;

use PHPUnit\Framework\TestCase;

final class PictureTest extends TestCase
{
    public function testPictureWithoutImageThrowsException()
    {
        $picture = new Picture;

        $this->expectException(\RuntimeException::class);
        $picture->render();
    }

    public function testPictureWithSourceFromImageRequest()
    {
        $image = new \Scene7\Requests\Image('https://example.com/', 'myProduct');
        $image->setWidth(200)->setHeight(200);
        $picture = new Picture;
        $picture->addSourceFromImage($image, [1, 2]);
        $picture->setImage($image);

        $this->assertEquals(
            '<picture><source srcset="https://example.com/myProduct?wid=400&hei=400 2x,https://example.com/myProduct?wid=200&hei=200 1x,"><img src="https://example.com/myProduct?wid=200&hei=200" alt=""></picture>',
            $picture->render()
        );
    }

    public function testPictureWithMultipleSourcesFromImageRequest()
    {
        $picture = new Picture;

        $image = new \Scene7\Requests\Image('https://example.com/', 'myProduct');
        $picture->setImage($image);
        $image->setWidth(500)->setHeight(500);
        $picture->addSourceFromImage($image, [1, 2], ['media' => '(min-width: 1000px)']);

        $image = new \Scene7\Requests\Image('https://example.com/', 'myProduct');
        $picture->setImage($image);
        $image->setWidth(250)->setHeight(250);
        $picture->addSourceFromImage($image, [1, 2], ['media' => '(min-width: 500px)']);

        $this->assertEquals(
            '<picture><source media="(min-width: 1000px)" srcset="https://example.com/myProduct?wid=1000&hei=1000 2x,https://example.com/myProduct?wid=500&hei=500 1x,"><source media="(min-width: 500px)" srcset="https://example.com/myProduct?wid=500&hei=500 2x,https://example.com/myProduct?wid=250&hei=250 1x,"><img src="https://example.com/myProduct?wid=250&hei=250" alt=""></picture>',
            $picture->render()
        );
    }

    public function testAddSourcesFromASingleImageWithASingleCall()
    {
        $picture = new Picture;
        $image = new \Scene7\Requests\Image('https://example.com/', 'myProduct');
        $queries = [
            '(min-width: 1000px)' => [
                'width' => 500,
                'height' => 500,
            ],
            '(min-width: 500px)' => [
                'width' => 250,
                'height' => 250,
            ],
        ];
        $picture->addSourceListFromImage($queries, $image, [2, 1])->setImage($image);

        $this->assertEquals(
            '<picture><source media="(min-width: 1000px)" srcset="https://example.com/myProduct?wid=1000&hei=1000 2x,https://example.com/myProduct?wid=500&hei=500 1x,"><source media="(min-width: 500px)" srcset="https://example.com/myProduct?wid=500&hei=500 2x,https://example.com/myProduct?wid=250&hei=250 1x,"><img src="https://example.com/myProduct?" alt=""></picture>',
            $picture->render()
        );
    }
}