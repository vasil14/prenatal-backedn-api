<?php

namespace App\Utilities\ProductFilters;

use App\Utilities\FilterContract;

class Title implements FilterContract
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function handle($value): void
    {
        $this->query
            ->where('title', 'like', '%' . $value . '%');
    }
}
