<?php
/**
 * JPGraph v4.0.3
 */

require_once '../vendor/autoload.php';


use Amenadiel\JpGraph\Graph;
use Amenadiel\JpGraph\Plot;

require_once 'data_load.php';

function draw_plot_scatter()
{
    $data = get_day_blood_tuple();
    $datax = $data["time"];
    $datay = $data["humidity"];
    $__width = 400;
    $__height = 300;
    $graph = new Graph\Graph($__width, $__height);
    $graph->SetScale('linlin');

    $graph->img->SetMargin(40, 40, 40, 40);
    $graph->SetShadow();
    $graph->SetScale('intint');
    $graph->title->Set('Humidity line plot');
    $graph->title->SetFont(FF_FONT1, FS_BOLD);


    $sp1 = new Plot\LinePlot($datay);
    // $sp1->mark->SetType(MARK_FILLEDCIRCLE);
    // $sp1->mark->SetFillColor("#ff8800");
    // $sp1->mark->SetWidth(8);

    $graph->Add($sp1);
    $graph->Stroke("images/plot_line.png");
}
