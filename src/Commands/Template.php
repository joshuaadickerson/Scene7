<?php

namespace Scene7\Commands;

trait Template
{
    /**
     * @param string $template
     * @return $this
     */
    public function setTemplate($template)
    {
        $this->addCommand(['template' => $template]);
        return $this;
    }
}