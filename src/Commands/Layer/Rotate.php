<?php

namespace Scene7\Commands\Layer;

trait Rotate
{
    public function setRotate($angle)
    {
        $this->addCommand(['rotate' => (float) $angle]);
        return $this;
    }
}