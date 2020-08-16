<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckStatus implements Rule
{
    protected $status;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($status)
    {
        $this->status = $status;
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
        if ($this->status) {
            if (isset($value)) {
                return false;
            } else {
                return true;
            }
        } else {
            if (isset($value)) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Tiền Lương Nhập Không Đúng';
    }
}
