<?php

namespace Traits;

trait QueryClauseHelperTrait
{
    /**
     * To build safe WHERE parts from filters, avoiding hard-coded names and SQL injection risks.
     */
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

    /**
     * To join WHERE parts into SQL string, keeping query clean without extra words when no filters.
     */
    public function bindWhereClause(?array $where): ?string 
    {
        return !empty($where) 
            ? ' WHERE ' . implode(' AND ', $where) 
            : '';
    }

    /**
     * To add LIMIT for pages, get only needed data, make queries faster for big tables.
     */
    public function bindLimitClause(int $start_from, int $result_per_page): string
    {
        return !empty($start_from) && !empty($result_per_page) 
            ? " LIMIT $start_from, $result_per_page" 
            : '';
    }
}
