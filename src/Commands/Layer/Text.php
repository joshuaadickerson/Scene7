<?php

namespace Scene7\Commands\Layer;

trait Text
{
    public function setText($text)
    {
        return $this->addCommand(['text' => $text]);
    }
}