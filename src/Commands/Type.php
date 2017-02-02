<?php

namespace Scene7\Commands;

trait Type
{
    public function setType($type)
    {
        $this->addCommand(array('type' => $type));
        return $this;
    }
}