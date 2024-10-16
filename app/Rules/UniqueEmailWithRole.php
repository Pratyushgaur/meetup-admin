<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\User;
class UniqueEmailWithRole implements ValidationRule
{


    protected $role;
    protected $column;

    public function __construct($role,$column)
    {
        // Store the role value
        $this->role = $role;
        $this->column = $column;
    }






    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail)  : void
    {
        

         // Build the query to check if the email exists with the same role
         $query = User::where($this->column, $value)->where('role', $this->role);
        
         // If a record exists, fail the validation
         if ($query->exists()) {
             $fail('The ' . $attribute . ' has already been taken.');
         }
        
    }

}
