<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\CategoryService;
use App\Validators\Admin\CategoryValidator;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->middleware('auth');
        $this->CategoryService = $categoryService;
    }

    public function allCategory(Request $request){
        try {
            $category = $this->CategoryService->categoryAll();
            return view('admin.blog.category.index')->with(compact('category'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function createCategory(Request $request){
        try {
            return view('admin.blog.category.create');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function storeCategory(Request $request){
        try {
            $input = $request->all();
            $categoryValidator = new CategoryValidator('add');

            if (!$categoryValidator->with($input)->passes()) {
                $errors = $categoryValidator->getErrors();
                foreach ($errors as $error) {
                    toastr()->error($error);
                }
                return back()->withErrors($categoryValidator->getValidator())->withInput();
            }

            $store = $this->CategoryService->categoryStore($input);
            if($store){
                toastr()->success('Successfully,  Category created!');
                return redirect('/all-categories');
            }else{
                toastr()->error('Sorry, unable to create!');
                return back();
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function viewCategory($id){
        try {
            $data = $this->CategoryService->categoryView($id);
            return view('admin.blog.category.edit')->with(compact('data'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function updateCategory(Request $request){
        try {
            $input = $request->all();
            $categoryValidator = new CategoryValidator('update');

            if (!$categoryValidator->with($input)->passes()) {
                $errors = $categoryValidator->getErrors();
                foreach ($errors as $error) {
                    toastr()->error($error);
                }
                return back()->withErrors($categoryValidator->getValidator())->withInput();
            }
            
            $update = $this->CategoryService->categoryUpdate($input);

            if($update){
                toastr()->success('Successfully,  Category updated!');
                return redirect('/all-categories');
            }else{
                toastr()->error('Sorry, unable to update!');
                return back();
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function deleteCategory($id){
        try {            
            $delete = $this->CategoryService->categoryDelete($id);

            if($delete){
                toastr()->success('Successfully,  Category deleted!');
                return redirect('/all-articles');
            }else{
                toastr()->error('Sorry, unable to delete!');
                return back();
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

}
