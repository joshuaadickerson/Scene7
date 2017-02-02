<?php

namespace Scene7\Commands;

trait Mask
{
    public function setMask($use)
    {
        if (!in_array($use, $this->getAllowedMaskUses())) {
            throw new \InvalidArgumentException('Invalid mask usage');
        }

        $this->addCommand(['maskUse' => $use]);
        return $this;
    }
}