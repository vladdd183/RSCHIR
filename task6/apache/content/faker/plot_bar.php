<?php

/**
 * JPGraph v4.0.3
 */

require_once '../vendor/autoload.php';

use Amenadiel\JpGraph\Graph;
use Amenadiel\JpGraph\Plot;

require_once 'data_load.php';

function draw_plot_bar()
{
// new Graph\Graph with a drop shadow
    $__width = 400;
    $__height = 300;
    $graph = new Graph\Graph($__width, $__height, 'auto');
    $graph->SetShadow();
    $graph->title->Set("5 volt bars");
    $graph->title->SetFont(FF_FONT1, FS_BOLD);


    $labels_and_values = get_labels_and_values('get_vout_type_count');
    $labels = $labels_and_values["labels"];
    $values = $labels_and_values["values"];

    $databary = $values;

    $graph->SetScale('textlin');
    $graph->xaxis->SetTickLabels($labels);
    $graph->title->SetFont(FF_FONT1, FS_BOLD);

    $b1 = new Plot\BarPlot($databary);
    $b1->SetLegend($_GET['property']);

//$b1->SetAbsWidth(6);
//$b1->SetShadow();

// The order the plots are added determines who's ontop
    $graph->Add($b1);

// Finally output the  image
// imagepng($graph->img->img);
    $graph->Stroke('images/plot_bar.png');
}