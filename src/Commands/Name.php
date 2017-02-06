<?php

namespace Scene7\Commands;

trait Name
{
    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->addCommand(array('name' => $name));
        return $this;
    }
}