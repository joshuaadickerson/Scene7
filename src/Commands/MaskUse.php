<?php

namespace Scene7\Commands;

trait MaskUse
{
    public function setMaskUse($use)
    {
        if (!in_array($use, $this->getAllowedMaskUses())) {
            throw new \InvalidArgumentException('Invalid mask usage');
        }

        $this->addCommand(['maskUse' => $use]);
        return $this;
    }

    public function getAllowedMaskUses()
    {
        return ['norm', 'invert', 'off'];
    }
}