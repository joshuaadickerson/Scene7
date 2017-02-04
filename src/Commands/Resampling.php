<?php

namespace Scene7\Commands;

use Scene7\Definitions\ResamplingModes;

trait Resampling
{
    public function setResampling($mode)
    {
        if (!in_array($mode, $this->getAllowedResamplingModes())) {
            throw new \InvalidArgumentException('Invalid resampling mode');
        }

        $this->addCommand(array('resMode' => $mode));
        return $this;
    }

    public function getAllowedResamplingModes()
    {
        return [
            ResamplingModes::BILIN,
            ResamplingModes::BICUB,
            ResamplingModes::SHARP2,
            ResamplingModes::TRILIN,
        ];
    }
}