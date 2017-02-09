<?php

namespace Scene7\Commands\Layer;

trait Opacity
{
    /**
     * @param int $percentage
     * @param null $fillPercentage
     * @return $this
     */
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