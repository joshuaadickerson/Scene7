<?php

namespace Scene7\Commands\Layer;

use Scene7\Definitions\AntiAliasingModes;
use Scene7\Definitions\TextResolutionModes;
use Scene7\Definitions\WordWrap;

trait TextAttributes
{
    public function setTextAttributes($resolution, $antiAliasing = null, $resolutionMode = null, $wordWrap = null)
    {
        $resolution = (int) $resolution;
        if ($resolution <= 0) {
            throw new \InvalidArgumentException('Invalid text resolution');
        }

        $attr = $resolution;

        if ($antiAliasing !== null || $resolutionMode !== null || $wordWrap !== null) {
            $antiAliasing = $antiAliasing ?: AntiAliasingModes::NORM;
            if (!in_array($antiAliasing, $this->getAllowedAntiAliasingModes())) {
                throw new \InvalidArgumentException('Invalid anti-aliasing mode');
            }

            $attr .= ',' . $antiAliasing;
        }

        if ($resolutionMode !== null || $wordWrap !== null) {
            if ($resolutionMode !== null && !in_array($resolutionMode, $this->getAllowedTextResolutionModes())) {
                throw new \InvalidArgumentException('Invalid text resolution mode');
            }

            $attr .= ',' . $resolutionMode;
        }

        if ($wordWrap !== null) {
            if (!in_array($wordWrap, $this->getAllowedWordWrapMode())) {
                throw new \InvalidArgumentException('Invalid word-wrap mode');
            }

            $attr .= ',' . $wordWrap;
        }

        $this->addCommand(['textAttr' => $attr]);
        return $this;
    }

    public function getAllowedAntiAliasingModes()
    {
        return [
            AntiAliasingModes::CRISP,
            AntiAliasingModes::NORM,
            AntiAliasingModes::OFF,
            AntiAliasingModes::SHARP,
            AntiAliasingModes::STRONG,
        ];
    }

    public function getAllowedTextResolutionModes()
    {
        return [
            TextResolutionModes::AUTO,
            TextResolutionModes::FIXED,
            TextResolutionModes::MAX,
        ];
    }

    public function getAllowedWordWrapMode()
    {
        return [
            WordWrap::NO_WRAP,
            WordWrap::NON_BREAKING,
            WordWrap::WRAP,
        ];
    }
}