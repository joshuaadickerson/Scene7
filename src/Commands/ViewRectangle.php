<?php

namespace Scene7\Commands;

trait ViewRectangle
{
    /**
     * @param float $coordX
     * @param float $coordY
     * @param float $sizeX
     * @param float $sizeY
     * @param float|null $scale
     * @return $this
     */
    public function setViewRectangle($coordX, $coordY, $sizeX, $sizeY, $scale = null)
    {
        $coordX = (float) $coordX;
        $coordY = (float) $coordY;
        $sizeX  = (float) $sizeX;
        $sizeY  = (float) $sizeY;

        $rectangle = $coordX . ',' . $coordY . ',' . $sizeX . ',' . $sizeY;
        if ($scale !== null) {
            $rectangle .= ',' . ((float) $scale);
        }

        $this->addCommand(['rect' => $rectangle]);
        return $this;
    }
}