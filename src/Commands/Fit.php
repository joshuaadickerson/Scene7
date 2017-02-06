<?php

namespace Scene7\Commands;

use Scene7\Definitions\FitModes as Mode;

trait Fit
{
    /**
     * @param string $mode Definitions\FitModes::*
     * @param bool $upscale
     * @return $this
     */
    public function setFitMode($mode, $upscale)
    {
        if (!in_array($mode, $this->getAllowedFitModes())) {
            throw new \InvalidArgumentException('Invalid fit mode');
        }

        $upscale = (int) (bool) $upscale;
        $this->addCommand(['fit' => $mode . ',' . $upscale]);
        return $this;
    }

    public function getAllowedFitModes()
    {
        return [
            Mode::FIT,
            Mode::CONSTRAIN,
            Mode::CROP,
            Mode::WRAP,
            Mode::STRETCH,
            Mode::HFIT,
            Mode::VFIT,
        ];
    }
}