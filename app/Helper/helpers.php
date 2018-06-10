<?php

if (!function_exists('current_iteration')) {
	function current_iteration(\Illuminate\Pagination\LengthAwarePaginator $collection, $loop)
	{
		if ($collection->currentPage() > 1) {
			return $loop->iteration + ($collection->perPage() * ($collection->currentPage() - 1));
		} else {
			return $loop->iteration;
		}
	}
}

if (!function_exists('sec_to_ydhm')) {
	function sec_to_ydhm($sec)
	{
		$years = intval(intval($sec) / 31104000);
		if ($years > 1) {
			return trans('site.time.years', compact('years'));
		} else if ($years > 0) {
			return trans('site.time.year');
		}

		$days = intval(intval($sec) / 86400);
		if ($days > 1) {
			return trans('site.time.days', compact('days'));
		} else if ($days > 0) {
			return trans('site.time.day');
		}

		$hours = intval(intval($sec) / 3600);
		if ($hours > 1) {
			return trans('site.time.hours', compact('hours'));
		} else if ($hours > 0) {
			return trans('site.time.hour');
		}

		$minutes = intval(($sec / 60) % 60);
		if ($minutes > 1) {
			return trans('site.time.minutes', compact('minutes'));
		} else if ($minutes > 0) {
			return trans('site.time.minute');
		}

		$seconds = intval(($sec) % 60);
		if ($seconds > 1) {
			return trans('site.time.seconds', compact('seconds'));
		} else if ($seconds >= 0) {
			return trans('site.time.second');
		}
	}
}