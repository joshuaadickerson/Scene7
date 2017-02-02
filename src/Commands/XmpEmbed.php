<?php

namespace Scene7\Commands;

trait XmpEmbed
{
    public function setXmpEmbed($embed)
    {
        $this->addCommand(array('xmpEmbed' => (int) (bool) $embed));
        return $this;
    }
}