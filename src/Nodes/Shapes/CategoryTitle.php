<?php
namespace Stryv\Nodes\Shapes;

use SVG\Nodes\Shapes\SVGPath;
use Stryv\Nodes\Structures\SVGDefs;
use Stryv\Nodes\Structures\SVGText;
use Stryv\Nodes\Structures\SVGTextPath;

class CategoryTitle extends SVGText
{
    protected $defs;

    public function __construct($defs, $cx, $cy, $r, $a, $ai, $text)
    {
        parent::__construct();

        $id = uniqid();

        if ($a >= 180 || 0 === $a) {
            $d  = 'M ';
            $d .= implode(' ', $this->polarToCartesian($cx, $cy, $a - ($ai / 2), $r * .97)) . ' ';
            $d .= 'A ' . $r . ' ' . $r . ' 0 0 1 ';
            $d .= implode(' ', $this->polarToCartesian($cx, $cy, $a + ($ai / 2), $r * .97)) . ' ';
        } else {
            $d  = 'M ';
            $d .= implode(' ', $this->polarToCartesian($cx, $cy, $a + ($ai / 2), $r)) . ' ';
            $d .= 'A ' . $r . ' ' . $r . ' 0 0 0 ';
            $d .= implode(' ', $this->polarToCartesian($cx, $cy, $a - ($ai / 2), $r)) . ' ';
        }

        $path = new SVGPath($d);
        $path->setAttribute('id', $id);

        $defs->addChild($path);

        $textPath = new SVGTextPath($text, '#' . $id);
        $textPath->setAttribute('startOffset', '50%');
        $this->addChild($textPath);
    }

    protected function polarToCartesian($cx, $cy, $a, $r)
    {
        $x = $cx + ($r * cos(deg2rad($a)));
        $y = $cy + ($r * sin(deg2rad($a)));

        return [$x, $y];
    }
}
