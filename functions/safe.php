<?php
function security($text): string
{
    return trim($text)
        .stripslashes($text)
        .htmlspecialchars($text);
}

?>
