<?php

namespace Scene7\Commands;

trait Mask
{
    /**
     * @param string $mask
     * @return $this
     */
    public function setMask($mask)
    {
        $this->addCommand(['mask' => $mask]);
        return $this;
    }
}