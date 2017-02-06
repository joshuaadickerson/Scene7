<?php

namespace Scene7\Commands;

trait Timeout
{
    /**
     * @param int $milliseconds
     * @return $this
     */
    public function setTimeout($milliseconds)
    {
        $this->addCommand(['timeout' => (int) $milliseconds]);
        return $this;
    }
}