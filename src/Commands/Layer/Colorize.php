<?php

namespace Scene7\Commands\Layer;

trait Colorize
{
    /**
     * @param string $color
     * @param string|null $compensation
     * @return $this
     */
    public function setColorize($color, $compensation = null)
    {
        $allowedCompensationModes = ['off', 'norm'];
        if ($compensation !== null && !in_array($compensation, $allowedCompensationModes) && ((float) $compensation < 0 || (float) $compensation > 100)) {
            throw new \InvalidArgumentException('Invalid compensation');
        }

        $colorize = $color;

        if ($compensation !== null) {
            $colorize .= ',' . (in_array($compensation, $allowedCompensationModes) ? $compensation : (float) $compensation);
        }

        $this->addCommand(['op_colorize' => $colorize]);
        return $this;
    }
}