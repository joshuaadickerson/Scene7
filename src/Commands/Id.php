<?php

namespace Scene7\Commands;

trait Id
{
    public function setId($id = null)
    {
        $id = $id ?: rand(0, PHP_INT_MAX);
        $this->addCommand(array('id' => (int) $id));
        return $this;
    }
}