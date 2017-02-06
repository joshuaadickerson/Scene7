<?php

namespace Scene7\Commands;

trait PrintResolution
{
    /**
     * @param int $dpi
     * @return $this
     */
    public function setPrintResolution($dpi)
    {
        $this->addCommand(array('printRes' => (int) $dpi));
        return $this;
    }
}