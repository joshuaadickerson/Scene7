<?php

namespace Scene7\Commands;

trait Locale
{
    /**
     * @param string $locale
     * @return $this
     */
    public function setLocale($locale)
    {
        $this->addCommand(['locale' => $locale]);
        return $this;
    }
}