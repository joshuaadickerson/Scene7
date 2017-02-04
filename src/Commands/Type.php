<?php

namespace Scene7\Commands;

trait Type
{
    public function setType($type)
    {
        $this->addCommand(['type' => $type]);
        return $this;
    }
}