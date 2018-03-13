<?php
/**
 * Created by PhpStorm.
 * User: Jean
 * Date: 13/03/2018
 * Time: 12:32
 */

class Vehicule
{
    public $masse;
    public $vitessInstantanee;
    public $vitesse;

    public function __construct($masse)
    {
        $this -> masse = $masse;
    }

    public function calculEnergieCinetique() : float
    {
        if ( $this -> masse >= 0 && $this -> vitesse >= 0 ){
            return 0.5 * ($this->masse * ($this->vitesse * $this ->vitesse));
        }
        else{
            return false;
        }

    }

}