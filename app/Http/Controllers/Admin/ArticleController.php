<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Services\Admin\ArticleService;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    protected $articleService;
    public function __construct(ArticleService $articleService)
    {
        $this->ArticleService = $articleService;
    }

    public function allArticles(Request $request){
        try {
            return view('admin.blog.article.all-articles');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function createArticles(Request $request){
        try {
            return view('admin.blog.article.create');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function storeArticles(Request $request){
        try {
            $input = $request->all();
            $validator = Validator::make($input, [
                'title' => 'required',
                'description' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg|max:1024',
            ]);
    
            if ($validator->fails()) {
                $messages = $validator->errors()->all();
                foreach($messages as $message){
                    toastr()->error($message);
                }
                return redirect()->back();
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
            \Log::error($e->getMessage()." ".$e->getFile()." ".$e->getLine());
        }
    }

    public function viewArticles(Request $request){
        try {
            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
