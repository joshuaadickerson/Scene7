<?php

namespace Scene7\Commands\Layer;

trait Hide
{
    public function setHide($hide)
    {
        $this->addCommand(['hide' => (int) (bool) $hide]);
        return $this;
    }
}