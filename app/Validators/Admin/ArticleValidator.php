<?php
namespace App\Validators\Admin;

use App\Validators\Validator;

class ArticleValidator extends Validator
{
    /**
     * Rules for User registration
     *
     * @var array
     */
    // protected $rules = [
    //     'category' =>'required',
    //     'title' => 'required',
    //     'description' => 'required',
    //     'image' => 'required|image|mimes:jpeg,png,jpg|max:1024',
    // ];

    public function __construct($validationFor = 'add')
    {
        $commonRules = [
            'category' =>'required',
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1024',
        ];
    
        if ($validationFor === 'update') {
            $commonRules['image'] = 'nullable';
        }
    
        $this->rules = $commonRules;
    }


} 