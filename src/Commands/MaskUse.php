<?php

namespace Scene7\Commands;

use Scene7\Definitions\MaskUses;

trait MaskUse
{
    /**
     * @param string $use One of MaskUses
     * @return $this
     */
    public function setMaskUse($use)
    {
        if (!in_array($use, $this->getAllowedMaskUses())) {
            throw new \InvalidArgumentException('Invalid mask usage');
        }

        $this->addCommand(['maskUse' => $use]);
        return $this;
    }

    /**
     * @return string[]
     */
    public function getAllowedMaskUses()
    {
        return [
            MaskUses::NORM,
            MaskUses::INVERT,
            MaskUses::OFF,
        ];
    }
}