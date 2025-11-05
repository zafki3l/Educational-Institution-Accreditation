<?php

namespace Core;

class Paginator
{
    const RESULT_PER_PAGE = 8;

    public static function paginate(int $total_records, int $result_per_page, int $current_page) : array
    {
        $total_pages = ceil($total_records / $result_per_page);

        $current_page = max(1, min($current_page, $total_pages));

        $start_from = ($current_page - 1) * $result_per_page;

        return [
            'total_pages' => $total_pages,
            'current_page' => $current_page,
            'start_from' => $start_from
        ];
    }
}