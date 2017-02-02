<?php

namespace Scene7;

use Scene7\Commands\Layer as LayerCommand;

/**
 * Class Layer
 * @package Scene7
 *
 * Layer is a special command because they have nested commands
 */
class Layer
{
    use LayerCommand\BackgroundColor,
        LayerCommand\BlendMode,
        LayerCommand\Blur,
        LayerCommand\Brightness,
        LayerCommand\Color,
        LayerCommand\ColorBalance,
        LayerCommand\Effect,
        LayerCommand\Extend,
        LayerCommand\Flip,
        LayerCommand\Hide;

    protected $id;
    protected $name;
    protected $commands = array();

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCommands()
    {
        return $this->commands;
    }

    public function getQuery()
    {
        return 'layer=' . $this->getId() . ($this->name ? ',' . $this->name : '') . '&' . urldecode(http_build_query($this->commands));
    }

    protected function addCommand(array $commands)
    {
        $this->commands = array_merge($this->commands, $commands);
        return $this;
    }

    public function __toString()
    {
        return $this->getQuery();
    }

    /*
     * To implement
     * bgColor
     * blendmode
     * clipPath
     * clipXPath
     * color
     * effect
     * extend
     * flip
     * hide
     * layer
     * map
     * mask
     * maskUse
     * op_blur
     * op_brightness
     * op_colorbalance
     * op_colorize
     * op_contrast
     * op_grow
     * op_hue
     * op_invert
     * op_noise
     * op_saturation
     * op_sharpen
     * op_usm
     * opac
     * origin
     * pathAttr
     * perspective
     * pos
     * rotate
     * size
     * src
     * text
     * textAngle
     * textAttr
     * textFlowPath
     * textFlowXPath
     * textPath
     * textPs
     *
     */
}