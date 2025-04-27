<?php declare(strict_types = 1);

if (!function_exists('calculate_duration')) {
    /**
     * Calculate the duration between two time strings.
     */
    function calculate_duration(string $startTime, string $endTime): string
    {
        $start = strtotime($startTime);
        $end   = strtotime($endTime);

        return gmdate('H:i:s', $end - $start);
    }
}

if (!function_exists('get_time_in_seconds')) {
    /**
     * Convert a time string to seconds.
     */
    function get_time_in_seconds(string $time): int
    {
        return strtotime($time) - strtotime('TODAY');
    }
}

if (!function_exists('add_up_times')) {
    /**
     * Add up multiple time strings.
     *
     * @param array<string> $times
     */
    function add_up_times(array $times): string
    {
        $totalSeconds = 0;

        foreach ($times as $time) {
            $totalSeconds += get_time_in_seconds($time);
        }

        return gmdate('H:i:s', $totalSeconds);
    }
}

if (!function_exists('subtract_times')) {
    /**
     * Subtract two time strings.
     */
    function subtract_times(string $timeToBeSubtracted, string $timeToSubtract): string
    {
        $timeToBeSubtractedInSeconds = get_time_in_seconds($timeToBeSubtracted);
        $timeToSubtractInSeconds     = get_time_in_seconds($timeToSubtract);

        return gmdate('H:i:s', $timeToBeSubtractedInSeconds - $timeToSubtractInSeconds);
    }
}
