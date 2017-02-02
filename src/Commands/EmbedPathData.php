<?php

namespace Scene7\Commands;

trait EmbedPathData
{
    public function setEmbedPathData($enable)
    {
        $this->addCommand(['pathEmbed' => (int) (bool) $enable]);
        return $this;
    }
}