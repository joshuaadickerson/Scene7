<?php

namespace Scene7\Commands;

trait EmbedColorProfile
{
    public function setEmbedColorProfile($embed)
    {
        $this->addCommand(['iccEmbed' => (int) (bool) $embed]);
        return $this;
    }
}