<?php

namespace Scene7\Commands\Layer;

trait Sharpen
{
    public function setSharpen($sharpen)
    {
        $this->addCommand(['op_sharpen' => (int) (bool) $sharpen]);
        return $this;
    }
}