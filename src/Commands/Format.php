<?php

namespace Scene7\Commands;

use Scene7\Definitions\Formats;
use Scene7\Definitions\PixelTypes;

trait Format
{
    /**
     * @param string $format Definitions\Formats
     * @param string $pixelType
     * @param string $compression
     * @return $this
     */
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
        return [
            Formats::JPEG,
            Formats::PNG,
            Formats::PNG_ALPHA,
            Formats::TIF,
            Formats::TIF_ALPHA,
            Formats::SWF,
            Formats::SWF_ALPHA,
            Formats::EPS,
            Formats::GIF,
            Formats::GIF_ALPHA,
            Formats::M3U8,
            Formats::F4M,
        ];
    }

    public function getAllowedPixelTypes()
    {
        return [
            PixelTypes::CMYK,
            PixelTypes::GRAY,
            PixelTypes::RGB,
        ];
    }

    public function getAllowedCompressionTypes()
    {
        return ['none', 'lzw', 'zip', 'jpeg'];
    }
}