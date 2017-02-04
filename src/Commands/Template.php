<?php

namespace Scene7\Commands;

trait Template
{
    public function setTemplate($template)
    {
        $this->addCommand(['template' => $template]);
        return $this;
    }
}