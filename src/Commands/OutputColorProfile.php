<?php

namespace Scene7\Commands;

use Scene7\Definitions\RenderIntents;

trait OutputColorProfile
{
    /**
     * @param string $object
     * @param string|null $renderIntent One of Definitions\OutputColorProfiles
     * @param bool|null $blackpointComp
     * @param bool|null $dither
     * @return $this
     */
    public function setOutputColorProfile($object, $renderIntent = null, $blackpointComp = null, $dither = null)
    {
        if (!in_array($renderIntent, $this->getAllowedRenderIntents())) {
            throw new \InvalidArgumentException('Invalid render intent');
        }

        $ocp = $object;

        if ($renderIntent !== null || $blackpointComp !== null || $dither !== null) {
            $ocp .= ',' . $renderIntent;
        }

        if ($blackpointComp !== null || $dither !== null) {
            $ocp .= ',' . (int) (bool) $blackpointComp;
        }

        if ($dither !== null) {
            $ocp .= ',' . (int) (bool) $dither;
        }

        $this->addCommand(['icc' => $ocp]);
        return $this;
    }

    public function getAllowedRenderIntents()
    {
        return [
            RenderIntents::ABSOLUTE,
            RenderIntents::PERCEPTUAL,
            RenderIntents::RELATIVE,
            RenderIntents::SATURATION,
        ];
    }
}