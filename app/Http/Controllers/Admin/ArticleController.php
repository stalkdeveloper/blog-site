<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Services\Admin\ArticleService;
use App\Services\Admin\CategoryService;
use Illuminate\Support\Facades\Validator;
use App\Validators\Admin\ArticleValidator;

class ArticleController extends Controller
{
    protected $articleService;
    protected $categoryService;

    public function __construct(ArticleService $articleService, CategoryService $categoryService)
    {
        $this->middleware('auth');
        $this->ArticleService = $articleService;
        $this->CategoryService = $categoryService;
    }

    public function allArticles(Request $request){
        try {
            $search = $request->search ?? '';

            $articles = $this->ArticleService->getArticles($request);
            $category = $this->CategoryService->category();

            return view('admin.blog.article.all-articles')->with(compact('articles', 'category', 'search'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function createArticles(Request $request){
        try {
            $category = $this->CategoryService->category();

            return view('admin.blog.article.create')->with(compact('category'));
        } catch (\Exception $e) {
            \Log::error($e->getMessage()." ".$e->getFile()." ".$e->getLine());
        }
    }

    public function storeArticles(Request $request){
        try {
            $input = $request->all();
            $articleValidator = new ArticleValidator('add');

            if (!$articleValidator->with($input)->passes()) {
                $errors = $articleValidator->getErrors();
                foreach ($errors as $error) {
                    toastr()->error($error);
                }
                return back()->withErrors($articleValidator->getValidator())->withInput();
            }

            $store = $this->ArticleService->articlesStore($input);

            if($store){
                toastr()->success('Successfully,  Article created!');
                return redirect('/all-articles');
            }else{
                toastr()->error('Sorry, unable to create!');
                return back();
            }
        } catch (\Exception $e) {
        }
    }

    public function viewArticles($id){
        try {
            $currenturl = url()->full();
            $parts = parse_url($currenturl);

            if (isset($parts['path'])) {
                $pathSegments = explode('/', $parts['path']);
                $editArticlesUrl = '';
                foreach ($pathSegments as $segment) {
                    if ($segment === "edit-articles") {
                        $editArticlesUrl = $segment;
                        break;
                    }elseif($segment === "view-articles"){
                        $editArticlesUrl = $segment;
                        break;
                    }
                }
            }

            if($editArticlesUrl == 'edit-articles'){
                $data = $this->ArticleService->articlesView($id);
                $category = $this->CategoryService->category();
                return view('admin.blog.article.edit')->with(compact('data', 'category'));
            }else if($editArticlesUrl == 'view-articles'){
                $data = $this->ArticleService->articlesView($id);
                return view('admin.blog.article.show')->with(compact('data'));
            }else{
                toastr()->warning('Sorry,  Invalid Data Found!');
                return back();
            }
        } catch (\Exception $e) {

        }
    }

    public function updateArticles(Request $request){
        try {
            $input = $request->all();
           $articleValidator = new ArticleValidator('update');

            if (!$articleValidator->with($input)->passes()) {
                $errors = $articleValidator->getErrors();
                foreach ($errors as $error) {
                    toastr()->error($error);
                }
                return back()->withErrors($articleValidator->getValidator())->withInput();
            }

            $store = $this->ArticleService->articlesUpdate($input);

            if($store){
                toastr()->success('Successfully,  Article updated!');
                return redirect('/all-articles');
            }else{
                toastr()->error('Sorry, unable to update!');
                return back();
            }
        } catch (\Exception $e) {
        }
    }

    public function deleteArticles($id){
        try {
            $delete = $this->ArticleService->articlesDelete($id);
            if($delete){
                toastr()->success('Successfully,  Article deleted!');
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
