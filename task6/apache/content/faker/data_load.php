<?php

function get_raw_data(): array {
    $input = file_get_contents('results.json');
    # echo print_r(json_decode($input));
    return json_decode($input);
}

function get_temp_count($data): array
{
    $temp_count = array();
    foreach ($data as $row) {
        $temperature = number_format($row->temperature, 1, '.', '');
        if (!isset($temp_count[$temperature])) {
            $temp_count[$temperature] = 0;
        }
        $temp_count[$temperature] += 1;
    }
    return $temp_count;
}

function get_vout_type_count($data): array
{
    $vout_type_count = array();
    foreach ($data as $row) {
        $vout = $row->vout;
        if(!isset($vout_type_count[$vout])) {
            $vout_type_count[$vout] = 0;
        }
        $vout_type_count[$vout] += 1;
    }
    return $vout_type_count;
}

function get_month_count($data): array
{
    $count = array();
    foreach ($data as $row) {
        $value = $row->month;
        if(!isset($count[$value])) {
            $count[$value] = 0;
        }
        $count[$value] += 1;
    }
    return $count;
}

function get_day_blood_tuple(): array {
    $data = get_raw_data();
    $humidity_array = array();
    $time_array = array();
    $time = array_column($data, 'time');

    array_multisort($time, SORT_ASC, $data);
    foreach ($data as $row) {
        $humidity_array[] = $row->humidity;
        $time_array[] = $row->time;
    }
    return array(
        "humidity" => $humidity_array,
        "time" => $time_array
    );
}

function get_labels_and_values($func) {
    $raw_data = get_raw_data();
    $day_count = $func($raw_data);
    $labels = array_keys($day_count);
    $values = array_values($day_count);
    return array("labels" => $labels, "values" => $values);
}