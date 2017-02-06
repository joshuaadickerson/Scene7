<?php

namespace Scene7\Commands;

trait Type
{
    /**
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->addCommand(['type' => $type]);
        return $this;
    }
}