<?php

namespace Scene7\Commands\Layer;

trait TextPath
{
    public function setTextPath($path)
    {
        return $this->addCommand(['textFlowPath' => $path]);
    }
}