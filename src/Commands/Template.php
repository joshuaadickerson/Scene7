<?php

namespace Scene7\Commands;

trait Template
{
    public function setTemplate($template)
    {
        $this->addCommand(array('template' => $template));
        return $this;
    }
}