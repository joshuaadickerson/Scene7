<?php

namespace Scene7\Requests;

use Scene7\Commands;

class SaveToFile extends AbstractRequest
{
    use Commands\LayerFactory,
        Commands\Align,
        Commands\Anchor,
        Commands\BackgroundColor,
        Commands\Cache,
        Commands\Crop,
        Commands\ColorQuantization,
        Commands\DefaultImage,
        Commands\EmbedColorProfile,
        Commands\EmbedPathData,
        Commands\Fit,
        Commands\Format,
        Commands\Height,
        Commands\Id,
        Commands\MaxJpegSize,
        Commands\Locale,
        Commands\Mask,
        Commands\MaskUse,
        Commands\Name,
        Commands\OutputColorProfile,
        Commands\PrintResolution,
        Commands\Quality,
        Commands\RegionOfInterest,
        Commands\Resolution,
        Commands\Resampling,
        Commands\Scale,
        Commands\ScaleView,
        Commands\Template,
        Commands\Timeout,
        Commands\Type,
        Commands\ViewRectangle,
        Commands\Width,
        Commands\XmpEmbed;

    public function __construct($baseUrl, $file, $name)
    {
        $this->setBaseUrl($baseUrl);
        $this->file = $file;
        $this->setName($name);
    }

    public function getRequestType()
    {
        return 'saveToFile';
    }
}