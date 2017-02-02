<?php

namespace Scene7\Commands;

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
        return array('bilin', 'bicub', 'sharp2', 'trilin');
    }
}