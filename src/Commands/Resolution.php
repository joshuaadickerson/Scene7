<?php

namespace Scene7\Commands;

trait Resolution
{
    public function setResolution($resolution)
    {
        $this->addCommand(['res' => (int) $resolution]);
        return $this;
    }
}