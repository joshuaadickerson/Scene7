<?php

namespace Scene7\Commands\Layer;

trait ClipPath
{
    public function setClipPath($path)
    {
        return $this->addCommand(['clipPath' => $path]);
    }

    public function setClipPathEmbedded($name)
    {
        return $this->addCommand(['clipPathE' => is_array($name) ? implode(',', $name) : $name]);
    }
}