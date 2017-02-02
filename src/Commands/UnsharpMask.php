<?php

namespace Scene7\Commands;

trait UnsharpMask
{
    public function setUnsharpMask($amount, $radius = null, $threshold = null, $monochrome = null)
    {
        if (!in_array($use, $this->getAllowedMaskUses())) {
            throw new \InvalidArgumentException('Invalid mask usage');
        }

        $this->addCommand(['maskUse' => $use]);
        return $this;
    }
}