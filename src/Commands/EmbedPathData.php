<?php

namespace Scene7\Commands;

trait EmbedPathData
{
    /**
     * @param bool $enable
     * @return $this
     */
    public function setEmbedPathData($enable)
    {
        $this->addCommand(['pathEmbed' => (int) (bool) $enable]);
        return $this;
    }
}