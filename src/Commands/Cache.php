<?php

namespace Scene7\Commands;

trait Cache
{
    /**
     * @param string $control
     * @return $this
     */
    public function setCache($control)
    {
        $this->addCommand(['cache' => $control]);
        return $this;
    }
}