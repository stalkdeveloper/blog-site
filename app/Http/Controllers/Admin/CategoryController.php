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
            $data = userInfo(); 
            if($data->can_read == '1' || \Auth::user()->usertype == 'admin'){
                $category = $this->CategoryService->categoryAll();
                return view('admin.blog.category.index')->with(compact('category'));
            }else{
                return view('admin.error.permission-denied');
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function createCategory(Request $request){
        try {
            $data = userInfo(); 
            if($data->can_create == '1' || \Auth::user()->usertype == 'admin'){
                return view('admin.blog.category.create');
            }else{
                return view('admin.error.permission-denied');
            }
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

    public function viewCategoryDetails($id){
        try {
            $data = userInfo(); 
            if($data->can_read == '1' || \Auth::user()->usertype == 'admin'){
                $data = $this->CategoryService->categoryView($id);
                return view('admin.blog.category.show')->with(compact('data'));
            }else{
                return view('admin.error.permission-denied');
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function viewCategory($id){
        try {
            $data = userInfo(); 
            if($data->can_update == '1' || \Auth::user()->usertype == 'admin'){
                $data = $this->CategoryService->categoryView($id);
                return view('admin.blog.category.edit')->with(compact('data'));
            }else{
                return view('admin.error.permission-denied');
            }
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
            $data = userInfo(); 
            if($data->can_delete == '1' || \Auth::user()->usertype == 'admin'){            
                $delete = $this->CategoryService->categoryDelete($id);

                if($delete){
                    toastr()->success('Successfully,  Category deleted!');
                    return redirect('/all-categories');
                }else{
                    toastr()->error('Sorry, unable to delete!');
                    return back();
                }
            }else{
                return view('admin.error.permission-denied');
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

}
