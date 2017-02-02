<?php

namespace Scene7\Commands;

trait Opacity
{
    public function setOpacity($percentage, $fillPercentage = null)
    {
        $opacity = (int) $percentage;
        if ($percentage < 0 || $percentage > 100) {
            throw new \InvalidArgumentException('Opacity percentage must be between 0 and 100');
        }

        if ($fillPercentage !== null) {
            $fillPercentage = (int) $fillPercentage;
            if ($fillPercentage < 0 || $fillPercentage > 100) {
                throw new \InvalidArgumentException('Fill opacity percentage must be between 0 and 100');
            }

            $opacity .= ',' . $fillPercentage;
        }

        $this->addCommand(['opac' => $opacity]);
        return $this;
    }
}