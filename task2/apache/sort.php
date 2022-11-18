<!DOCTYPE html>
<html lang="en">
<body>
<?php

function quick_sort($array) {
    if (count($array) < 2) {
        return $array;
    }
    $target = $array[0];
    $less = array(); $equal = array($target); $greater = array();
    for ($i = 1; $i < count($array); $i++) {
        $elem = $array[$i];
        if ($elem > $target) {
            $greater[] = $elem;
        } elseif ($elem < $target) {
            $less[] = $elem;
        } else {
            $equal[] = $elem;
        }
    }
    $less = quick_sort($less);
    $greater = quick_sort($greater);
    return array_merge($less, $equal, $greater);
}

function print_array($array): void {
    echo "<pre>[";
    echo implode(", ", $array);
    echo "]</pre>";
}

if (isset($_GET['array'])) {
    $array = explode(",", $_GET["array"]);
    echo "<p>Считанный массив</p>";
    print_array($array);
    $array = quick_sort($array);
    echo "<p>Отсортированный массив</p>";
    print_array($array);
} 
?>
</body>
</html>
