<?php

namespace App\Rules;

use App\Curricula;
use Illuminate\Contracts\Validation\Rule;

class Check_Course implements Rule
{
    public $level;

    /**
     * Create a new rule instance.
     *
     * @param $level
     */
    public function __construct($level)
    {
        //
        $this->level = $level;
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
        //
        return Curricula::where('level',$this->level)->where('course_data',$value)->count() == 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '已擁有此課程';
    }
}
