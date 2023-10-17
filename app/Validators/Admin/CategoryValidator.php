<?php
namespace App\Validators\Admin;

use App\Validators\Validator;

class CategoryValidator extends Validator
{
    /**
     * Rules for User registration
     *
     * @var array
     */

    public function __construct($validationFor = 'add')
    {
        $commonRules = [
            'title' => 'required',
            'description' => 'required',
        ];
    
        if ($validationFor === 'update') {
            //
        }
    
        $this->rules = $commonRules;
    }


} 