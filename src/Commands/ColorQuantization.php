<?php

namespace Scene7\Commands;

trait ColorQuantization
{
    public function setColorQuantization($type, $disableDiffuse = false, $numColors = null, $colorList = null)
    {
        if (!in_array($type, $this->getAllowedColorQuantizationTypes())) {
            throw new \InvalidArgumentException('Invalid palette type');
        }

        $quantize = $type;
        if ($disableDiffuse || $numColors !== null || $colorList !== null) {
            $quantize .= ',' . ($disableDiffuse ? 'off' : 'diffuse');
        }

        if ($numColors !== null || $colorList !== null) {
            $quantize .= ',' . $numColors;
        }

        if ($colorList !== null) {
            $quantize .= ',' . $colorList;
        }

        $this->addCommand(['quantize' => $quantize]);
        return $this;
    }

    public function getAllowedColorQuantizationTypes()
    {
        return ['adaptive', 'web', 'mac'];
    }
}