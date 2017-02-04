<?php

namespace Scene7\Commands\Layer;

trait TextAngle
{
    public function setTextAngle($angle)
    {
        $this->addCommand(['textAngle' => (float) $angle]);
        return $this;
    }
}