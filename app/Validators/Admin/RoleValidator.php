<?php
namespace App\Validators\Admin;

use App\Validators\Validator;

class RoleValidator extends Validator
{
    /**
     * Rules for User registration
     *
     * @var array
     */

    public function __construct($validationFor = 'add')
    {
        $commonRules = [
            'can_create' => 'required',
            'can_read' => 'required',
            'can_update' => 'required',
            'can_delete' => 'required',
            'user' => 'required',
            'usertype' => 'required',
            // 'module' => 'required',
        ];
    
        if ($validationFor === 'update') {
            //
        }
    
        $this->rules = $commonRules;
    }


} 