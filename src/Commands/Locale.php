<?php

namespace Scene7\Commands;

trait Locale
{
    public function setLocale($locale)
    {
        $this->addCommand(['locale' => $locale]);
        return $this;
    }
}