<?php declare(strict_types = 1);

namespace App\Common\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EndTimeMustBeGreaterThanStartTime implements ValidationRule
{
    public function __construct(private readonly string $startTimeField = 'start_time')
    {
    }

    /**
     * Run the validation rule.
     *
     * @param \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $startTime = request($this->startTimeField);
        $endTime   = $value;

        if ($startTime && $endTime && strtotime((string) $startTime) >= strtotime((string) $endTime)) {
            $fail('O horário final deve ser maior que o horário inicial.');
        }
    }
}
