<?php
function html($str): string
{
    return
        htmlspecialchars(trim($str), ENT_QUOTES);
}

function mb_ucFirst($string): string
{
    $string = mb_strtolower($string);
    return mb_strtoupper(mb_substr( $string, 0, 1 )) . mb_substr( $string, 1 );
}