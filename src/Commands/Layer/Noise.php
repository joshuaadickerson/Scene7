<?php

namespace Scene7\Commands\Layer;

trait Noise
{
    public function setNoise($value, $distribution = null, $monochrome = null)
    {
        $value = (int) $value;
        if ($value < 0 || $value > 100) {
            throw new \InvalidArgumentException('Invalid value');
        }

        if ($distribution !== null && !in_array($distribution, $this->getAllowedNoiseDistributions())) {
            throw new \InvalidArgumentException('Invalid distribution');
        }

        $noise = $value;

        if ($distribution !== null || $monochrome !== null) {
            $noise .= ','. ($distribution ?: 'uniform');
        }

        if ($monochrome !== null) {
            $noise .= ',' . (int) (bool) $monochrome;
        }

        $this->addCommand(['op_noise' => $noise]);
        return $this;
    }

    public function getAllowedNoiseDistributions()
    {
        return ['uniform', 'gaussian'];
    }
}