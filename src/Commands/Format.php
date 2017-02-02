<?php

namespace Scene7\Commands;

trait Format
{
    public function setFormat($format, $pixelType = '', $compression = '')
    {
        if (!in_array($format, $this->getAllowedFormats())) {
            throw new \InvalidArgumentException('Invalid format type');
        }

        if ($pixelType && !in_array($pixelType, $this->getAllowedPixelTypes())) {
            throw new \InvalidArgumentException('Invalid pixel type');
        }

        if ($compression && !in_array($compression, $this->getAllowedCompressionTypes())) {
            throw new \InvalidArgumentException('Invalid compression type');
        }

        $command = $format;

        if ($pixelType) {
            $command .= ',' . $pixelType;
        }

        if ($compression) {
            $command .= ',' . $compression;
        }

        $this->addCommand(['fmt' => $command]);
        return $this;
    }

    public function getAllowedFormats()
    {
        return array('jpeg', 'png', 'png-alpha', 'tif', 'tif-alpha', 'swf', 'swf-alpha', 'eps', 'gif', 'gif-alpha', 'm3u8', 'f4m');
    }

    public function getAllowedPixelTypes()
    {
        return array('rgb', 'gray', 'cmyk');
    }

    public function getAllowedCompressionTypes()
    {
        return array('none', 'lzw', 'zip', 'jpeg');
    }
}