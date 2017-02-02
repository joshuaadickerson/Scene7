<?php

namespace Scene7\Commands;

trait RegionOfInterest
{
    public function setRegionOfInterest($coordX, $coordY, $sizeX, $sizeY)
    {
        $coordX = (int) $coordX;
        $coordY = (int) $coordY;
        $sizeX = (int) $sizeX;
        $sizeY = (int) $sizeY;

        $region = $coordX . ',' . $coordY . ',' . $sizeX . ',' . $sizeY;

        $this->addCommand(array('rgn' => $region));
        return $this;
    }
}