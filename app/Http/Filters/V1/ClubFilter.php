<?php

namespace App\Http\Filters\V1;

use App\Http\Filters\ApiFilter;
use App\Models\Club;

class ClubFilter extends ApiFilter
{
    public function __construct()
    {
        $this->class = Club::class;
    }

    protected array $allowedParameters = [
        'name'         => ['eq', 'ne'],
        'abbreviation' => ['eq', 'ne'],
        'zvr'          => ['set', 'null', 'eq'],
        'location'     => ['set', 'null', 'eq', 'ne'],
        'founded'      => ['set', 'null', 'eq', 'ne'],
        'province'     => ['set', 'null', 'eq', 'ne'],
        'website'      => ['set', 'null', 'set', 'empty'],
        'facebook'     => ['set', 'null', 'set', 'empty'],
        'instagram'    => ['set', 'null', 'set', 'empty'],
        'email'        => ['set', 'null', 'set', 'empty'],
        'status'       => ['eq', 'ne'],
    ];
}