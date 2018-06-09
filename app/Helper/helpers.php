<?php

if (!function_exists('current_iteration')) {
	function current_iteration(\Illuminate\Pagination\LengthAwarePaginator $collection, $loop)
	{
		if($collection->currentPage() > 1) {
			return $loop->iteration + ($collection->perPage() * ($collection->currentPage() - 1));
		} else {
			return $loop->iteration;
		}
	}
}