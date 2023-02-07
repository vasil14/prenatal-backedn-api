<?php

namespace App\Utilities\ProductFilters;

use App\Utilities\FilterContract;

class Prezzo implements FilterContract
{
  protected $query;

  public function __construct($query)
  {
    $this->query = $query;
  }

  public function handle($value): void
  {
    list($min, $max) = explode(",", $value);

    $this->query
      ->where('price', '>=',  $min)
      ->where('price', '<=', $max);
  }
}
