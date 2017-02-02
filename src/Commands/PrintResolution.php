<?php

namespace Scene7\Commands;

trait PrintResolution
{
    public function setPrintResolution($dpi)
    {
        $this->addCommand(array('printRes' => (int) $dpi));
        return $this;
    }
}