<?php

namespace Scene7\Helpers\Html\Attributes;

use Scene7\Helpers\ImageMultiplier;
use Scene7\RenderInterface;
use Scene7\Requests\Image;

class Srcset implements RenderInterface
{
    use ImageMultiplier;

    /** @var string */
    protected $srcset = '';
    /** @var Image */
    protected $image;
    /** @var Int[] */
    protected $multipliers = [];

    public function __construct($srcset = '', Image $image = null, array $multipliers = [])
    {
        $this->srcset = $srcset;
        $this->setImage($image);
        $this->setMultipliers($multipliers);
    }

    public function setImage(Image $image = null)
    {
        $this->image = $image;
        return $this;
    }

    public function setMultipliers(array $multipliers = [])
    {
        $this->multipliers = $multipliers;
        return $this;
    }

    public function render()
    {
        return $this->image instanceof Image ? $this->renderFromImage() : $this->srcset;
    }

    protected function renderFromImage()
    {
        $srcset = '';

        if (!empty($this->multipliers)) {
            $images = $this->getMultipliedImages($this->image, $this->multipliers);
            foreach ($images as $multiplier => $multImage) {
                $srcset .= $multImage->render() . ' ' . ((int) $multiplier) . 'x,';
            }
        } else {
            $srcset = $this->image->render();
        }

        return $srcset;
    }

    public function __toString()
    {
        return $this->render();
    }
}