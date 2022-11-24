<?php
require_once '../vendor/autoload.php';

use Amenadiel\JpGraph\Graph;
use Amenadiel\JpGraph\Plot;

require_once 'data_load.php';

function draw_plot_pie()
{
    $graph = new Graph\PieGraph(400, 300);
    $graph->title->Set("Temperature pie");
    $graph->title->SetFont(FF_FONT1, FS_BOLD);
    $graph->SetBox(true);

    $labels_and_values = get_labels_and_values('get_temp_count');
    $labels = $labels_and_values["labels"];

    for ($i = 0; $i < count($labels); $i++) {
        $labels[$i] = $labels[$i]." Cels";
    }
    $values = $labels_and_values["values"];

    $p1 = new Plot\PiePlot($values);
    $p1->ShowBorder();
    $p1->SetColor('black');
# $p1->SetSliceColors(array('#1E90FF', '#2E8B57', '#ADFF2F', '#DC143C', '#BA55D3'));
    $p1->SetLabels($labels);

    $graph->Add($p1);

    $graph->Stroke("images/plot_pie.png");
}