<?php

namespace Scene7\Commands\Layer;

use Scene7\Definitions\BlendModes;

trait BlendMode
{
    /**
     * @param string $mode One of Scene7\Definitions\BlendModes
     */
    public function setBlendMode($mode)
    {
        if (!in_array($mode, $this->getAllowedBlendModes())) {
            throw new \InvalidArgumentException('Invalid blend mode');
        }

        $this->addCommand(array('blendMode' => $mode));
    }

    public function getAllowedBlendModes()
    {
        return [
            BlendModes::DARKEN,
            BlendModes::DISSOLVE,
            BlendModes::LIGHTEN,
            BlendModes::MULT,
            BlendModes::NORM,
            BlendModes::SCREEN,
        ];
    }
}