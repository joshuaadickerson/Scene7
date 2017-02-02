<?php

namespace Scene7\Commands;

trait Height
{
    public function setHeight($height)
    {
        $height = (int) $height;
        if ($height < 1) {
            throw new \InvalidArgumentException('Height must be an integer greater than 0');
        }

        $this->addCommand(['hei' => $height]);
        return $this;
    }
}