<?php
$env = fopen("../.env", "r") or die("Unable to open file!");
while(!feof($env)){
    $line = fgets($env);
    $key = explode("=",$line)[0];
    $value = explode('"', explode("=",$line)[1])[1];
    $_ENV[$key] = $value;
}

fclose($env);
?>
