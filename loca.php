<?php

// LOCA - Localization Engine.
$LocaLang = "en";

$LOCA = array ();
//
function loca ($key)
{
    global $LOCA, $LocaLang;
    if ( gettype($LOCA[$LocaLang]) !== "array" ) return "$key";
    if ( key_exists ( $key, $LOCA[$LocaLang]) ) return $LOCA[$LocaLang][$key];
    else return "$key";
}

//
function loca_add ($key, $value)
{
    global $LOCA, $LocaLang;
    $LOCA[$LocaLang][$key] = $value;
}

?>
