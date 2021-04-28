<?php

namespace App\Service;

use App\Entity\Oeuvre;

class InfoStringService {
  public function oeuvre(Oeuvre $oeuvre){
    return $oeuvre->getName() . " de " . $oeuvre->getComposer()->getName(); 
  }
}