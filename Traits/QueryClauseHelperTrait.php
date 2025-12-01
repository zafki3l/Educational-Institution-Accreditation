<?php

namespace Traits;

trait QueryClauseHelperTrait
{
    public function buildWhereClause(array $filter, array $columns): array
    {
        $where = [];
        $params = [];
        foreach ($filter as $key => $value) {
            if (!empty($value)) {
                $where[] = $columns[$key] . ' = ? ';
                $params[] = $value;
            }
        }

        return [
            'where' => $where,
            'params' => $params
        ];
    }

    public function bindWhereClause(?array $where): ?string 
    {
        return !empty($where) ? ' WHERE ' . implode(' AND ', $where) : '';
    }

    public function bindLimitClause(int $start_from, int $result_per_page): string
    {
        return !empty($start_from) && !empty($result_per_page) 
                    ? " LIMIT $start_from, $result_per_page" : '';
    }
}
