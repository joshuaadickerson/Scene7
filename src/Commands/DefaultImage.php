<?php

namespace Scene7\Commands;

trait DefaultImage
{
    public function setDefaultImage($image)
    {
        $this->addCommand(['defaultImage' => $image]);
        return $this;
    }
}