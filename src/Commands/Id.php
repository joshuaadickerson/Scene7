<?php

namespace Scene7\Commands;

trait Id
{
    /**
     * Used to bust caches
     *
     * @param int|null $id null generates a random id
     * @return $this
     */
    public function setId($id = null)
    {
        $id = $id ?: rand(0, PHP_INT_MAX);
        $this->addCommand(['id' => (int) $id]);
        return $this;
    }
}