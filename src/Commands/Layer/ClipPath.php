<?php

namespace Scene7\Commands\Layer;

trait ClipPath
{
    /**
     * @param string $path
     * @return mixed
     */
    public function setClipPath($path)
    {
        return $this->addCommand(['clipPath' => $path]);
    }

    /**
     * @param string|string[] $name
     * @return mixed
     */
    public function setClipPathEmbedded($name)
    {
        return $this->addCommand(['clipPathE' => is_array($name) ? implode(',', $name) : $name]);
    }
}