<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Прака 6</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
          crossorigin="anonymous">
</head>
<body>
<?php
require_once "faker.php";

generate_data();
?>
<?php
require_once "plot_bar.php";
require_once "plot_pie.php";
require_once "plot_line.php";

draw_plot_pie();
draw_plot_bar();
draw_plot_scatter();
?>
<?php
require_once "watermark.php";

$images = array("images/plot_pie.png", "images/plot_bar.png", "images/plot_line.png");

foreach ($images as $image) {
    add_watermark($image);
}
?>
<img src="images/plot_pie.png" alt="plot_1.png">
<img src="images/plot_bar.png" alt="plot_2.png">
<img src="images/plot_line.png" alt="plot_3.png">

<table class="table">
    <tr>
        <th>Vin (24v)</th>
        <th>Vout (5v)</th>
        <th>Temperature</th>
        <th>Pressure</th>
        <th>Humidity</th>
        <th>Sound Level</th>
        <th>Time</th>
    </tr>
    <?php
    $data = get_raw_data();

    foreach ($data as $data_row) {
        echo "<tr>";
        echo "<td>".$data_row->vin."</td>";
        echo "<td>".$data_row->vout."</td>";
        echo "<td>".$data_row->temperature."</td>";
        echo "<td>".$data_row->pressure."</td>";
        echo "<td>".$data_row->humidity."</td>";
        echo "<td>".$data_row->soundLevel."</td>";
        echo "<td>".gmdate("Y-m-d H:i:s", $data_row->time)."</td>";
        echo "</tr>";
    }
    ?>
</table>
</body>
</html>
