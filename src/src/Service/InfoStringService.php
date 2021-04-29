<?php

namespace App\Service;

use App\Entity\Oeuvre;

class InfoStringService {
  public function oeuvre(Oeuvre $oeuvre){
    return $oeuvre->getName() . " by " . $oeuvre->getComposer()->getName(); 
  }
}