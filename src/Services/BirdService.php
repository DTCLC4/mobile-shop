<?php

namespace App\Services;
use App\Contracts\BirdServiceInterface;

class BirdService implements BirdServiceInterface{
  public function fly()
  {
      return 'fly fly fly';
  }
}
