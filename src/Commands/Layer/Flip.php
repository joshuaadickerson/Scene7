<?php

namespace Scene7\Commands\Layer;

trait Flip
{
    public function setFlip($direction)
    {
        if (!in_array($direction, ['lr', 'ud', 'lrud'])) {
            throw new \InvalidArgumentException('Invalid flip direction');
        }


        $this->addCommand(['flip' => $direction]);
        return $this;
    }
}