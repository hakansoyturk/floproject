<?php
function readDb(): array
{
    $folder = fopen("veri.db", "r");
    $counter = 0;
    $lineArray = array();
    while (!feof($folder)) {
        $line = fgets($folder);
        $lineArray[$counter] = trim($line);
        $counter++;
    }
    fclose($folder);
    return $lineArray;
}

?>
