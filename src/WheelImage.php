<?php
namespace Stryv;

use SVG\SVGImage;
use Stryv\Nodes\Shapes\CategoryChart;
use Stryv\Nodes\Structures\SVGDefs;

class WheelImage extends SVGImage
{
    public function __construct(array $categories)
    {
        parent::__construct(null, null, []);

        $document = $this->getDocument();
        $document->setAttribute('viewBox', '0 0 500 500');

        $defs = new SVGDefs();
        $document->addChild($defs);

        $ai = 360 / count($categories);
        $a = 0;

        $chart = new CategoryChart(500, 500, $defs);
        $chart->buildGrid();

        foreach ($categories as $title => list($fill, $score)) {
            $chart->buildSegment($fill, $title, $score, $a, $ai);
            $a += $ai;
        }

        $document->addChild($chart);
    }
}
