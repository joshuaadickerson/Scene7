<?php

namespace Scene7\Commands\Layer;

trait Map
{
    public function setMap($map, $source = false)
    {
        $source ? $this->setMap($map) : $this->setMapSource($map);
        return $this;
    }

    public function setMapLayer($map)
    {
        $map = urlencode($map);
        $this->addCommand(['map' => $map]);
    }

    public function setMapSource($map)
    {
        $map = urlencode($map);
        $this->addCommand(['mapA' => $map]);
    }
}