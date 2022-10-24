<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class ApiFilter
{
    const OPERATOR_MAP = [
        'set'  => '',
        'null' => '',
        'eq'   => '=',
        'ne'   => '<>',
        'like' => 'like',
        'in'   => 'in',
        'gt'   => '>',
        'ge'   => '>=',
        'lt'   => '<',
        'le'   => '<=',
    ];

    protected array $allowedParameters;
    protected array $columnMap;
    protected string $class;

    public function filter(Request $request): Builder
    {
        $nullQuery = [];
        $notNullQuery = [];
        $whereQuery = [];
        foreach ($this->allowedParameters as $parameter => $operators) {
            $query = $request->query($parameter);

            if (!isset($query)) {
                continue;
            }

            $column = $this->columnMap[$parameter] ?? $parameter;

            foreach ($operators as $operator) {
                if (!isset($query[$operator])) {
                    continue;
                }
                switch ($operator) {
                case 'empty':
                    if ($query[$operator]) {
                        $nullQuery[] = $column;
                    }
                    break;
                case 'set':
                    if ($query[$operator]) {
                        $notNullQuery[] = $column;
                    }
                    break;
                default:
                    $whereQuery[] = [$column, self::OPERATOR_MAP[$operator], $query[$operator]];
                };
            }
        }

        $queryBuilder = $this->class::where($whereQuery);

        foreach ($nullQuery as $column) {
            $queryBuilder->whereNull($column);
        }
        foreach ($notNullQuery as $column) {
            $queryBuilder->whereNotNull($column);
        }

        return $queryBuilder;
    }
}