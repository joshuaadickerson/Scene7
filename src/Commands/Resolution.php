<?php

namespace Scene7\Commands;

trait Resolution
{
    /**
     * @param int $resolution
     * @return $this
     */
    public function setResolution($resolution)
    {
        $this->addCommand(['res' => (int) $resolution]);
        return $this;
    }
}