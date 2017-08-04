<?php
namespace Stryv\Nodes\Shapes;

use SVG\Nodes\Shapes\SVGCircle;
use SVG\Nodes\Shapes\SVGLine;
use SVG\Nodes\Shapes\SVGPath;
use SVG\Nodes\Structures\SVGGroup;
use Stryv\Nodes\Structures\SVGDefs;
use Stryv\Nodes\Structures\SVGText;
use Stryv\Nodes\Structures\SVGTextPath;

class CategoryChart extends SVGGroup
{
    protected $defs;

    protected $docWidth;
    protected $docHeight;
    protected $canvasWidth;

    protected $cx;
    protected $cy;
    protected $r;

    protected $outerRingPercentage = 0.95;
    protected $innerRingPercentage = 0.88;
    protected $textPercentage = 0.955;

    public function __construct($docWidth, $docHeight, $defs)
    {
        parent::__construct();

        $this->defs = $defs;

        $this->docWidth = $docWidth;
        $this->docHeight = $docHeight;

        if ($this->docWidth >= $this->docHeight) {
            $this->canvasWidth = $this->docHeight;
        } else {
            $this->canvasWidth = $this->docWidth;
        }

        $this->cx = floor($this->docWidth / 2) ;
        $this->cy = floor($this->docHeight / 2);
        $this->r  = floor($this->canvasWidth * 0.5 * $this->outerRingPercentage);
    }

    public function buildGrid()
    {
        $r = $this->r * $this->innerRingPercentage;
        for ($i = 1; $i < 10; $i++) {
            $ir = ($r / 10) * $i;

            $circle = new SVGCircle($this->cx, $this->cy, $ir);
            $circle->setAttribute('fill', 'none');
            $circle->setAttribute('stroke', '#ccc');
            $circle->setAttribute('stroke-width', '2');
            $this->addChild($circle);
        }
    }

    public function buildSegment($fill, $title, $score, $a, $ai)
    {
        if (100 === $score) {
            $sr = $this->r * $this->innerRingPercentage * 1.1;
        } else {
            $sr = ($this->r * $this->innerRingPercentage) * ($score / 100);
        }
        $wedge = new CategoryScore($this->cx, $this->cy, $sr, $a, $ai);
        $wedge->setAttribute('fill', $fill);
        $wedge->setAttribute('fill-opacity', '0.8');
        $this->addChild($wedge);

        $band = new CategoryBand($this->cx, $this->cy, $this->r, $a, $ai);
        $band->setAttribute('stroke', 'black');
        $band->setAttribute('stroke-width', '2');
        $band->setAttribute('fill', $fill);
        $this->addChild($band);

        $text = new CategoryTitle($this->defs, $this->cx, $this->cy, $this->r * $this->textPercentage, $a, $ai, $title);
        $text->setAttribute('text-anchor', 'middle');
        $text->setAttribute('font-family', 'Arial');
        $text->setAttribute('font-size', '14');
        $text->setAttribute('fill', 'white');
        $this->addChild($text);

        $c = $this->polarToCartesian($this->cx, $this->cy, $a + ($ai / 2), $this->r * $this->innerRingPercentage);
        $line = new SVGLine($c[0], $c[1], $this->cx, $this->cy);
        $line->setAttribute('stroke', 'black');
        $line->setAttribute('stroke-width', '2');
        $this->addChild($line);
    }

    protected function polarToCartesian($cx, $cy, $a, $r)
    {
        $x = $cx + ($r * cos(deg2rad($a)));
        $y = $cy + ($r * sin(deg2rad($a)));

        return [$x, $y];
    }
}
