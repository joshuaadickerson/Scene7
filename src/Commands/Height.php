<?php

namespace Scene7\Commands;

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
}