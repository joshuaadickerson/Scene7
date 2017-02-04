<?php

namespace Scene7\Commands;

use Scene7\Commands\Layer as LayerCommand;
use Scene7\RenderInterface;

/**
 * Class Layer
 * @package Scene7
 *
 * Layer is a special command because they have nested commands
 */
class Layer implements RenderInterface
{
    use LayerCommand\BackgroundColor,
        LayerCommand\BlendMode,
        LayerCommand\Blur,
        LayerCommand\Brightness,
        LayerCommand\ClipPath,
        LayerCommand\Color,
        LayerCommand\ColorBalance,
        LayerCommand\Colorize,
        LayerCommand\Effect,
        LayerCommand\Extend,
        LayerCommand\Flip,
        LayerCommand\Grow,
        LayerCommand\Hide,
        LayerCommand\Hue,
        LayerCommand\Invert,
        LayerCommand\Map,
        LayerCommand\Noise,
        LayerCommand\Opacity,
        LayerCommand\Origin,
        LayerCommand\PathAttributes,
        LayerCommand\PathEmbed,
        LayerCommand\Position,
        LayerCommand\Saturation,
        LayerCommand\Sharpen,
        LayerCommand\Text,
        LayerCommand\TextAngle,
        LayerCommand\TextAttributes,
        LayerCommand\TextFlowPath,
        LayerCommand\TextPath,
        LayerCommand\TextPhotoshopCompatible;

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

    public function render()
    {
        return $this->getQuery();
    }

    public function __toString()
    {
        return $this->render();
    }

    /*
     * To implement
     * src
     *
     */
}