<?php

namespace Scene7\Commands;

trait MaxJpegSize
{
    public function setMaxJpegSize($kilobytes)
    {
        if ((int) $kilobytes > 0) {
            $this->addCommand(['jpegSize' => (int) $kilobytes]);
        }

        return $this;
    }
}