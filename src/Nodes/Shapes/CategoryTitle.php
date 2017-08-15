<?php
namespace Stryv\Nodes\Shapes;

use SVG\Nodes\Shapes\SVGPath;
use Stryv\Nodes\Structures\SVGDefs;
use Stryv\Nodes\Structures\SVGText;
use Stryv\Nodes\Structures\SVGTextPath;

class CategoryTitle extends SVGText
{
    protected $defs;

    protected $d;

    public function __construct($defs, $cx, $cy, $r, $a, $ai, $text)
    {
        parent::__construct();

        $id = uniqid();

        if ($a >= 180 || 0 === $a) {
            $ir = $r; // * .97;
            $d  = 'M ';
            $d .= implode(' ', $this->polarToCartesian($cx, $cy, $a - ($ai / 2), $ir)) . ' ';
            $d .= 'A ' . $ir . ' ' . $ir . ' 0 0 1 ';
            $d .= implode(' ', $this->polarToCartesian($cx, $cy, $a + ($ai / 2), $ir)) . ' ';
            $dy = '8';
        } else {
            $d  = 'M ';
            $d .= implode(' ', $this->polarToCartesian($cx, $cy, $a + ($ai / 2), $r)) . ' ';
            $d .= 'A ' . $r . ' ' . $r . ' 0 0 0 ';
            $d .= implode(' ', $this->polarToCartesian($cx, $cy, $a - ($ai / 2), $r)) . ' ';
            $dy = '0';
        }

        $path = new SVGPath($d);
        $path->setAttribute('id', $id);

        $this->d = $d;

        $defs->addChild($path);

        $textPath = new SVGTextPath($text, '#' . $id);
        $textPath->setAttribute('startOffset', '50%');
        $this->setAttribute('dy', $dy);
        $this->addChild($textPath);
    }

    public function getPath()
    {
        $path2 = new SVGPath($this->d);
        $path2->setAttribute('stroke', '#000');
        $path2->setAttribute('stroke-width', '2');
        $path2->setAttribute('fill', 'none');
        return $path2;
    }

    protected function polarToCartesian($cx, $cy, $a, $r)
    {
        $x = $cx + ($r * cos(deg2rad($a)));
        $y = $cy + ($r * sin(deg2rad($a)));

        return [$x, $y];
    }
}
