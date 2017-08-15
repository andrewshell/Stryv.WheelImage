<?php
namespace Stryv\Nodes\Shapes;

use SVG\Nodes\Shapes\SVGPath;

class CategoryBand extends SVGPath
{
    public function __construct($cx, $cy, $r, $a, $ai)
    {
        // Move to start
        $d  = 'M ';
        $d .= implode(
            ' ',
            $this->polarToCartesian(
                $cx,
                $cy,
                $a + ($ai / 2),
                $r
            )
        ) . ' ';

        // Outer Arc
        $d .= 'A ' . $r . ' ' . $r . ' 0 0 0 ';
        $d .= implode(
            ' ',
            $this->polarToCartesian(
                $cx,
                $cy,
                $a - ($ai / 2),
                $r
            )
        ) . ' ';

        $ir = $r * .88;

        // Side Line
        $d .= 'L ';
        $d .= implode(
            ' ',
            $this->polarToCartesian(
                $cx,
                $cy,
                $a - ($ai / 2),
                $ir
            )
        ) . ' ';

        // Inner Arc
        $d .= 'A ' . $ir . ' ' . $ir . ' 0 0 1 ';
        $d .= implode(
            ' ',
            $this->polarToCartesian(
                $cx,
                $cy,
                $a + ($ai / 2),
                $ir
            )
        ) . ' ';

        // Close Shape
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
