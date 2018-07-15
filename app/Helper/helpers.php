<?php

use Illuminate\Pagination\LengthAwarePaginator;

if (!function_exists('current_iteration')) {
    function current_iteration(LengthAwarePaginator $collection, $loop): int
    {
        if ($collection->currentPage() > 1) {
            return $loop->iteration + ($collection->perPage() * ($collection->currentPage() - 1));
        } else {
            return $loop->iteration;
        }
    }
}
