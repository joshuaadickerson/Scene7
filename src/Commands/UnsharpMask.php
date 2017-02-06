<?php

namespace Scene7\Commands;

trait UnsharpMask
{
    /**
     * @param float $amount
     * @param float|null $radius
     * @param float|null $threshold
     * @param bool|null $monochrome
     * @return $this
     */
    public function setUnsharpMask($amount, $radius = null, $threshold = null, $monochrome = null)
    {
        $amount = (float) $amount;
        if ($amount < 0 || $amount > 5) {
            throw new \InvalidArgumentException('Invalid amount');
        }

        if ($radius !== null) {
            $radius = (float) $radius;
            if ($radius < 0 || $radius > 250) {
                throw new \InvalidArgumentException('Invalid radius');
            }
        }

        if ($threshold !== null) {
            $threshold = (float) $threshold;
            if ($threshold < 0 || $threshold > 255) {
                throw new \InvalidArgumentException('Invalid threshold');
            }
        }

        $mask = $amount;

        if ($radius !== null || $threshold !== null || $monochrome !== null) {
            $mask .= ',' . $radius;
        }

        if ($threshold !== null || $monochrome != null) {
            $mask .= ',' . $threshold;
        }

        if ($monochrome !== null) {
            $mask .= ',' . (int) (bool) $monochrome;
        }

        $this->addCommand(['op_usm' => $mask]);
        return $this;
    }
}