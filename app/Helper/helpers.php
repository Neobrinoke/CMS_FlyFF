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

if (!function_exists('sec_to_ydhm')) {
    function sec_to_ydhm($sec): ?string
    {
        $years = intval(intval($sec) / 31104000);
        if ($years > 1) {
            return trans('trans/time.years', [
                'years' => $years
            ]);
        } elseif ($years > 0) {
            return trans('trans/time.year');
        }

        $days = intval(intval($sec) / 86400);
        if ($days > 1) {
            return trans('trans/time.days', [
                'days' => $days
            ]);
        } elseif ($days > 0) {
            return trans('trans/time.day');
        }

        $hours = intval(intval($sec) / 3600);
        if ($hours > 1) {
            return trans('trans/time.hours', [
                'hours' => $hours
            ]);
        } elseif ($hours > 0) {
            return trans('trans/time.hour');
        }

        $minutes = intval(($sec / 60) % 60);
        if ($minutes > 1) {
            return trans('trans/time.minutes', [
                'minutes' => $minutes
            ]);
        } elseif ($minutes > 0) {
            return trans('trans/time.minute');
        }

        $seconds = intval(($sec) % 60);
        if ($seconds > 1) {
            return trans('trans/time.seconds', [
                'seconds' => $seconds
            ]);
        } elseif ($seconds >= 0) {
            return trans('trans/time.second');
        }

        return null;
    }
}