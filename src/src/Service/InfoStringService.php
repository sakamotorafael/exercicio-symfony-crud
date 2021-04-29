<?php

namespace App\Service;

use App\Entity\Oeuvre;
use App\Entity\Piece;

class InfoStringService {
  public function oeuvre(Oeuvre $oeuvre){
    return $oeuvre->getName() . " by " . $oeuvre->getComposer()->getName(); 
  }
  public function piece(Piece $piece){
    return $piece->getTitle() . " n. " . $piece->getNumber() . " in " . $piece->getTonality();  
  }
}