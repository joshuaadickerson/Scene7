<?php

namespace Scene7\Helpers;

use Scene7\Requests\Image;

trait ImageMultiplier
{
    /**
     * @param Image $image
     * @param array $multipliers
     * @return Image[]
     */
    protected function getMultipliedImages(Image $image, array $multipliers = [])
    {
        rsort($multipliers);
        $images = [];
        foreach ($multipliers as $multiplier) {
            $images[$multiplier] = $this->imageMultiplier($image, $multiplier);
        }
        return $images;
    }

    /**
     * @param Image $image
     * @param $multiplier
     * @return Image
     */
    protected function imageMultiplier(Image $image, $multiplier)
    {
        $width = $image->getWidth();
        $height = $image->getHeight();

        $multImage = clone $image;

        if ($width !== null) {
            $multImage->setWidth($width * $multiplier);
        }

        if ($height !== null) {
            $multImage->setHeight($height * $multiplier);
        }

        return $multImage;
    }
}