<?php

namespace Scene7\Commands;

trait Name
{
    public function setName($name)
    {
        $this->addCommand(array('name' => $name));
        return $this;
    }
}