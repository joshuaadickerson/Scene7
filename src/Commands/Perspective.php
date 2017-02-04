<?php

namespace Scene7\Commands;

use Scene7\Definitions\PerspectiveOptions;

trait Perspective
{
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

    public function setPerspectiveNormalized($topLeft, $topRight, $bottomLeft, $bottomRight, $resamplingMode = null)
    {
        return $this->setPerspective($topLeft, $topRight, $bottomLeft, $bottomRight, $resamplingMode, true);
    }

    protected function isAllowedPerspectiveResamplingMode($mode)
    {
        if (substr($mode, 0, 3) === 'R3T') {
            $jitter = (int) substr($mode, 3);

            return $jitter >= 0 || $jitter <= 200;
        }

        return in_array($mode, $this->getAllowedPerspectiveResamplingMode());
    }

    public function getAllowedPerspectiveResamplingMode()
    {
        return [
            PerspectiveOptions::R1,
            PerspectiveOptions::R2,
            PerspectiveOptions::R3,
        ];
    }
}