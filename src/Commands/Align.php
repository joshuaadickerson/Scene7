<?php

namespace Scene7\Commands;

trait Align
{
    /**
     * @param float $horizontal
     * @param float $vertical
     * @return $this
     */
    public function setAlign($horizontal, $vertical)
    {
        $horizontal = (float) $horizontal;
        $vertical   = (float) $vertical;
        $this->addCommand(['align' => $horizontal . ',' . $vertical]);
        return $this;
    }
}