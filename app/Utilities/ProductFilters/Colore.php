<?php

namespace App\Utilities\ProductFilters;

use App\Utilities\FilterContract;

class Colore implements FilterContract
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function handle($value): void
    {
        $this->query
            ->where('colore',  $value);
    }
}
