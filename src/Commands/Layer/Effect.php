<?php

namespace Scene7\Commands\Layer;

trait Effect
{
    /**
     * @param int $effect
     * @return $this
     */
    public function setEffect($effect)
    {
        $effect = (int) $effect;
        if ($effect === 0) {
            throw new \InvalidArgumentException('Effect must not equal 0');
        }


        $this->addCommand(['effect' => $effect]);
        return $this;
    }
}