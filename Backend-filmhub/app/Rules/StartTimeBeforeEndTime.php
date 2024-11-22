<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class StartTimeBeforeEndTime implements Rule
{
   
    private $end_time;

    public function __construct($end_time)
    {
        $this->end_time = $end_time;
    }

    public function passes($attribute, $value)
    {
        try {
            $start_time = new \DateTime($value);
            $end_time = new \DateTime($this->end_time);

            return $start_time < $end_time;
        } catch (\Exception $e) {
            return false; // Invalid date format
        }
    }

    public function message()
    {
        return 'The start time must be earlier than the end time.';
    }
}
