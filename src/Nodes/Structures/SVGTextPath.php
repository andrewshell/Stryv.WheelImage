<?php
namespace Stryv\Nodes\Structures;

use SVG\Nodes\SVGNodeContainer;

class SVGTextPath extends SVGNodeContainer
{
    const TAG_NAME = 'textPath';

    protected $text;

    public function __construct($text = '', $href = null)
    {
        parent::__construct();

        $this->text = $text;

        $this->setAttributeOptional('xlink:href', $href);
    }

    public function getText()
    {
        return $this->text;
    }
}
