<?php
namespace Stryv\Nodes\Structures;

use SVG\Nodes\SVGNodeContainer;

class SVGText extends SVGNodeContainer
{
    const TAG_NAME = 'text';

    protected $text;

    public function __construct($text = '', $x = null, $y = null, $dx = null, $dy = null)
    {
        parent::__construct();

        $this->text = $text;

        $this->setAttributeOptional('x', $x);
        $this->setAttributeOptional('y', $y);
        $this->setAttributeOptional('dx', $dx);
        $this->setAttributeOptional('dy', $dy);
    }

    public function getText()
    {
        return $this->text;
    }
}
