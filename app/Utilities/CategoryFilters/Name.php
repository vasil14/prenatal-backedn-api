<?php

namespace App\Utilities\CategoryFilters;

use App\Utilities\FilterContract;

class Name implements FilterContract
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function handle($value): void
    {
        $this->query->where('name', $value);
    }
}
