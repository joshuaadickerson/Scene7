<?php

namespace Scene7\Commands\Layer;

trait TextFlowPath
{
    public function setTextFlowPath($path)
    {
        return $this->addCommand(['textFlowPath' => $path]);
    }

    public function setTextFlowXPath($path)
    {
        return $this->addCommand(['textFlowXPath' => $path]);
    }
}