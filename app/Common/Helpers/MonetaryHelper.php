<?php declare(strict_types = 1);

if (!function_exists('convert_to_cents')) {
    /**
     * Convert decimal value to cents. (for storage)
     */
    function convert_to_cents(?string $value = null): int
    {
        if ($value === null) {
            return 0;
        }

        $value = floatval($value);

        return (int) ($value * 100);
    }
}

if (!function_exists('convert_to_decimal')) {
    /**
     * Convert cents to decimal value. (for display)
     */
    function convert_to_decimal(?int $value = null, bool $decimal = true): string
    {
        if ($decimal == true) {
            return number_format($value / 100, 2, '.', ',');
        }

        return (string) ($value / 100);
    }
}

if (!function_exists('calculate_total_receivable')) {
    /**
     * Calculate the total receivable based on the hourly rate and duration.
     */
    function calculate_total_receivable(int $hourlyRate, string $duration): int
    {
        $totalSeconds = get_time_in_seconds($duration);

        return (int) (($totalSeconds / 3600) * $hourlyRate);
    }
}
