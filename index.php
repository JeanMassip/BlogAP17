<?php

include "./functions/classAutoLoader.php";
spl_autoload_register('classAutoLoader()');

$voiture1 = new Voiture(1200);

$voiture1->vitesse = 60;

if($ec = $voiture1 ->calculEnergieCinetique()){
    $ec = $ec . " Joules";
    Log::logWrite($ec);
}