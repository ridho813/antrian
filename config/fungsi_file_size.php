<?php
function MakeReadable($bytes) {
    $i = floor(log($bytes, 1024));
    return round($bytes / pow(1024, $i), [0,0,2,2,3][$i]).[' B',' KB',' MB',' GB',' TB'][$i];
}
?>
