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
}