<?php

namespace Scene7\Commands\Layer;

trait BlendMode
{
    public function setBlendMode($mode)
    {
        if (!in_array($mode, $this->getAllowedBlendModes())) {
            throw new \InvalidArgumentException('Invalid blend mode');
        }

        $this->addCommand(array('blendMode' => $mode));
    }

    public function getAllowedBlendModes()
    {
        return ['norm', 'dissolve', 'lighten', 'darken', 'mult', 'screen'];
    }
}