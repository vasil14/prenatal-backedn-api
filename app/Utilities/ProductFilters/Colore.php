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
        $colors = explode(',', $value);

        if (count($colors) === 1) {
            $this->query
                ->where('colore',  $colors[0]);
        } else {

            $this->query
                ->orWhere('colore', ...$colors);
        }
    }
}
