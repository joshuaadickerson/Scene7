<?php

namespace Scene7\Commands\Layer;

trait TextPhotoshopCompatible
{
    public function setTextPs($path)
    {
        return $this->addCommand(['textPs' => $path]);
    }
}