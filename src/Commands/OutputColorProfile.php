<?php

namespace Scene7\Commands;

trait OutputColorProfile
{
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
        return array('perceptual', 'relative', 'saturation', 'absolute');
    }
}