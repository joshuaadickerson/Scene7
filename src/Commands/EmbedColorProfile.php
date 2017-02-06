<?php

namespace Scene7\Commands;

trait EmbedColorProfile
{
    /**
     * @param bool $embed
     * @return $this
     */
    public function setEmbedColorProfile($embed)
    {
        $this->addCommand(['iccEmbed' => (int) (bool) $embed]);
        return $this;
    }
}