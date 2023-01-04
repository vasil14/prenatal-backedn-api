<?php

namespace App\Utilities\ProductFilters;

use App\Utilities\FilterContract;

class Category implements FilterContract
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function handle($value): void
    {
        $this->query
            ->whereHas('categories', function ($q) use ($value) {
                $q->where('name', 'like', $value);
            });
    }
}
