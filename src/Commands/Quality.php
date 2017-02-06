<?php

namespace Scene7\Commands;

trait Quality
{
    /**
     * @param int $percentage
     * @param bool|null $chroma
     * @return $this
     */
    public function setQuality($percentage, $chroma = null)
    {
        $percentage = (int) $percentage;
        if ($percentage < 1 || $percentage > 100) {
            throw new \InvalidArgumentException('Quality percentage must be between 1 and 100');
        }

        $quality = $percentage;
        if ($chroma !== null) {
            $quality .= ',' . ((int) (bool) $chroma);
        }

        $this->addCommand(array('qlt' => $quality));
        return $this;
    }
}