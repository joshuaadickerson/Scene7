<?php

namespace Scene7\Commands;

use Scene7\Commands\Layer as LayerCommand;
use Scene7\RenderInterface;

/**
 * Layer is a special command because it has nested commands
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
        LayerCommand\Source,
        LayerCommand\Text,
        LayerCommand\TextAngle,
        LayerCommand\TextAttributes,
        LayerCommand\TextFlowPath,
        LayerCommand\TextPath,
        LayerCommand\TextPhotoshopCompatible;

    /** @var int|string */
    protected $id;
    /** @var string */
    protected $name;
    /** @var string[] */
    protected $commands = [];

    /**
     * Layer constructor.
     * @param int|string $id
     * @param string $name
     */
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
}