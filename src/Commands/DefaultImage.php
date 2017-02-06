<?php

namespace Scene7\Commands;

trait DefaultImage
{
    /**
     * @param string $image
     * @return $this
     */
    public function setDefaultImage($image)
    {
        $this->addCommand(['defaultImage' => $image]);
        return $this;
    }
}