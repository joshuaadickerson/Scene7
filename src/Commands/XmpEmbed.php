<?php

namespace Scene7\Commands;

trait XmpEmbed
{
    /**
     * @param bool $embed
     * @return $this
     */
    public function setXmpEmbed($embed)
    {
        $this->addCommand(array('xmpEmbed' => (int) (bool) $embed));
        return $this;
    }
}