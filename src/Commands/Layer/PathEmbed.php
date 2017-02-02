<?php

namespace Scene7\Commands\Layer;

trait PathEmbed
{
    public function setPathEmbed($pathEmbed)
    {
        $this->addCommand(['pathEmbed' => (int) (bool) $pathEmbed]);
    }
}