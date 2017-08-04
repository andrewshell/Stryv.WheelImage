<?php
namespace Stryv\Nodes\Shapes;

use SVG\Nodes\Shapes\SVGCircle;
use SVG\Nodes\Shapes\SVGPath;
use SVG\Nodes\Structures\SVGGroup;
use Stryv\Nodes\Structures\SVGDefs;
use Stryv\Nodes\Structures\SVGText;
use Stryv\Nodes\Structures\SVGTextPath;

class CategoryScore extends SVGPath
{
    public function __construct($cx, $cy, $r, $a, $ai)
    {
        $d  = 'M ';
        $d .= implode(' ', $this->polarToCartesian($cx, $cy, $a + ($ai / 2), $r)) . ' ';
        $d .= 'A ' . $r . ' ' . $r . ' 0 0 0 ';
        $d .= implode(' ', $this->polarToCartesian($cx, $cy, $a - ($ai / 2), $r)) . ' ';
        $d .= 'L ' . $cx . ' ' . $cy . ' ';
        $d .= 'Z';

        parent::__construct($d);
    }

    protected function polarToCartesian($cx, $cy, $a, $r)
    {
        $x = $cx + ($r * cos(deg2rad($a)));
        $y = $cy + ($r * sin(deg2rad($a)));

        return [$x, $y];
    }
}
