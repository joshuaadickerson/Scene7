<?php

namespace Scene7\Commands;

use Scene7\Requests\AbstractRequest;

trait Width
{
    /**
     * @param int $width
     * @return $this
     */
    public function setWidth($width)
    {
        $width = (int) $width;
        if ($width < 1) {
            throw new \InvalidArgumentException('Width must be an integer greater than 0');
        }

        $this->addCommand(['wid' => $width]);
        return $this;
    }

    /**
     * @return int|null
     */
    public function getWidth()
    {
        return isset($this->commands['wid']) ? $this->commands['wid'] : null;
    }

    /**
     * @param array $commands
     * @return AbstractRequest
     */
    abstract public function addCommand(array $commands);
}