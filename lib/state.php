<?php

function state_read($page, $appID,$varName)
{
    $path = $page . ':' . $appID . ':' . $varName;
    return $val = $_SESSION['$path'];
}
function state_write($page, $appID,$varname, $value)
{
    $path = $page . ':' . $appID . ':' . $varName;
    $_SESSION['$path'] = $value;  
}
?>