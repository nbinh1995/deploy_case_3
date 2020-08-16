<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class SalaryRule implements Rule
{
    protected $salary_max;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($salary_max)
    {
        $this->salary_max = $salary_max;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $value <= $this->salary_max;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Tiền lương cao nhất phải lớn hơn tiền lương thấp nhất';
    }
}
