<?php

namespace Scene7;

interface RenderInterface
{
    /**
     * @return string
     */
    public function render();

    /**
     * @return string
     */
    public function __toString();
}