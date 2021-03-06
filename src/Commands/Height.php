<?php

namespace Scene7\Commands;

use Scene7\Requests\AbstractRequest;

trait Height
{
    /**
     * @param int $height
     * @return $this
     */
    public function setHeight($height)
    {
        $height = (int) $height;
        if ($height < 1) {
            throw new \InvalidArgumentException('Height must be an integer greater than 0');
        }

        $this->addCommand(['hei' => $height]);
        return $this;
    }

    /**
     * @return null|int
     */
    public function getHeight()
    {
        return isset($this->commands['hei']) ? $this->commands['hei'] : null;
    }

    /**
     * @param array $commands
     * @return AbstractRequest
     */
    abstract public function addCommand(array $commands);
}