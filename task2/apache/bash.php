<!DOCTYPE html>
<html lang="en">
<body>
<?php
function print_cmd($cmd) {
    $lines = array();
    exec($cmd, $lines);
    echo "<pre> > ".$cmd."</pre>";
    echo "<pre>".implode("\n", $lines)."</pre>";
}

$command_list = array("ls", "ps", "whoami", "id");
foreach ($command_list as $cmd) {
    print_cmd($cmd);
}
?>
</body>
</html>
