<?php

namespace Scene7\Commands\Layer;

trait PathAttributes
{
    public function setPathAttributes($direction, $startPos = null, $endPos = null)
    {
        if (!in_array($direction, ['norm', 'reverse'])) {
            throw new \InvalidArgumentException('Invalid direction');
        }

        $pathAttr = $direction;

        if ($startPos !== null || $endPos !== null) {
            $startPos = (float) $startPos;
            if ($startPos < 0 || $startPos > 1) {
                throw new \InvalidArgumentException('Invalid start position');
            }

            $pathAttr .= ',' . $startPos;
        }

        if ($endPos !== null) {
            $endPos = (float) $endPos;
            if ($endPos < 0 || $endPos >= 2) {
                throw new \InvalidArgumentException('Invalid end position');
            }

            $pathAttr .= ',' . $endPos;
        }

        $this->addCommand(['pathAttr' => $pathAttr]);
        return $this;
    }
}