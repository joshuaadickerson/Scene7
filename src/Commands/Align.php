<?php

namespace Scene7\Commands;

use Scene7\Requests\AbstractRequest;

trait Align
{
    /**
     * @param float $horizontal
     * @param float $vertical
     * @return AbstractRequest
     */
    public function setAlign($horizontal, $vertical)
    {
        $horizontal = (float) $horizontal;
        $vertical   = (float) $vertical;
        $this->addCommand(['align' => $horizontal . ',' . $vertical]);
        return $this;
    }

    /**
     * @param array $commands
     * @return AbstractRequest
     */
    abstract public function addCommand(array $commands);
}