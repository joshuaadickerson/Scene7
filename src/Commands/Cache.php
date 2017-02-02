<?php

namespace Scene7\Commands;

trait Cache
{
    public function setCache($control)
    {
        $this->addCommand(['cache' => $control]);
        return $this;
    }
}