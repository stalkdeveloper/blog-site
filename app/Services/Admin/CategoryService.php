<?php

namespace App\Services\Admin;

use App\Services\Service;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Auth;

class CategoryService extends Service
{
    public function category($request){
        try {
            $category = Category::orderBy('id', 'desc')->get();
            return $category;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}