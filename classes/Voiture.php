<?php
class Voiture
{
    public $nbrRoue;
    public $couleur;
    public $masse;
    public $carburant;
    public $vitesse;

    public function calculEnergieCinetique()
    {
        if ( $this -> masse >0 && $this -> vitesse >0 ){
            $carre = $this -> masse * $this -> vitesse /2;
            return $carre * $carre;
        }
        else{
            return false;
        }

    }

}