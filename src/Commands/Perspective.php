<?php

namespace Scene7\Commands;

use Scene7\Definitions\PerspectiveOptions;

trait Perspective
{
    /**
     * @param float $topLeft
     * @param float $topRight
     * @param float $bottomLeft
     * @param float $bottomRight
     * @param string|null $resamplingMode One of Definitions\ResamplingModes
     * @param bool $normalized
     * @return $this
     */
    public function setPerspective($topLeft, $topRight, $bottomLeft, $bottomRight, $resamplingMode = null, $normalized = false)
    {
        $topLeft        = (float) $topLeft;
        $topRight       = (float) $topRight;
        $bottomLeft     = (float) $bottomLeft;
        $bottomRight    = (float) $bottomRight;

        $perspective = $topLeft . ',' . $topRight . ',' . $bottomLeft . ',' . $bottomRight;

        if ($resamplingMode !== null && $this->isAllowedPerspectiveResamplingMode($resamplingMode)) {
            $perspective .= $resamplingMode;
        }

        $this->addCommand([$normalized ? 'perspectiveN' : 'perspective' => $perspective]);
        return $this;
    }

    /**
     * @param float $topLeft
     * @param float $topRight
     * @param float $bottomLeft
     * @param float $bottomRight
     * @param string|null $resamplingMode One of Definitions\ResamplingModes
     * @return $this
     */
    public function setPerspectiveNormalized($topLeft, $topRight, $bottomLeft, $bottomRight, $resamplingMode = null)
    {
        return $this->setPerspective($topLeft, $topRight, $bottomLeft, $bottomRight, $resamplingMode, true);
    }

    /**
     * @param string $mode
     * @return bool
     */
    protected function isAllowedPerspectiveResamplingMode($mode)
    {
        if (substr($mode, 0, 3) === 'R3T') {
            $jitter = (int) substr($mode, 3);

            return $jitter >= 0 || $jitter <= 200;
        }

        return in_array($mode, $this->getAllowedPerspectiveResamplingMode());
    }

    /**
     * @return string[]
     */
    public function getAllowedPerspectiveResamplingMode()
    {
        return [
            PerspectiveOptions::R1,
            PerspectiveOptions::R2,
            PerspectiveOptions::R3,
        ];
    }
}