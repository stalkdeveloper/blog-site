<?php

namespace App\Services\Admin;

use App\Services\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Article;
use Auth;

class ArticleService extends Service
{
    public function getArticles($request){
        try {
            $articleQuery = Article::with(['users', 'categories'])->select('*');

            $filter = $request['filter'];
            $search = $request['search'];
            $category = $request['category'];

            if (!empty($category)) {
                $articleQuery = $articleQuery->whereHas('categories', function ($q) use ($category) {
                    $q->where('id', $category);
                });
            } else if ($filter == 'articles' && !empty($search)) {
                $articleQuery = $articleQuery->where(function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%')
                        ->orWhere('content', 'like', '%' . $search . '%');
                });
            } else if (!empty($category) && !empty($search)) {
                $articleQuery = $articleQuery->where('category_id', $category)->where(function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%')
                        ->orWhere('content', 'like', '%' . $search . '%');
                });
            }

            $articles = $articleQuery->orderBy('id', 'desc')->paginate(10, ['*'], 'articles');
            return $articles;
        } catch (\Exception $e) {
        }
    }

    public function articlesStore($request)
    {
        try {
            $data = new Article();
            $data->user_id = Auth::user()->id;
            $data->category_id  = $request['category'];
            $data->title = $request['title'];
            $data->content = $request['description'];

            // if ($request['image']) {
            //     $image = $request['image'];
            //     $imageName = time() . '.' . $image->getClientOriginalExtension();
            //     $image->move(public_path('images'), $imageName);
            //     $data->image = $imageName;
            // }

            if ($request['image']) {
                $image = $request['image'];
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                Storage::disk('public')->put('images/' . $imageName, file_get_contents($image));
                $data->image = 'images/' . $imageName;
            }

            if ($data->save()) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            \Log::error($e->getMessage() . " " . $e->getFile() . " " . $e->getLine());
        }
    }

    public function articlesView($id){
        try {
            $getArticle = Article::with(['users', 'categories'])->where('id', $id)->first();
            return $getArticle;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function articlesUpdate($request){
        try {
            $getArticle = Article::where('id', $request['id'])->first();
            $updateImage;

            if (isset($request['image'])) {
                if ($getArticle->image) {
                    Storage::disk('public')->delete($getArticle->image);
                    Article::where('id', $request['id'])->update(['image' => '']);
                }   

                $image = $request['image'];
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                Storage::disk('public')->put('images/' . $imageName, file_get_contents($image));
                $updateImage = 'images/' . $imageName;
            }else{
                $updateImage = $getArticle->image;
            }

            $data = [
                'category_id' => $request['category'],
                'user_id' => Auth::user()->id,
                'title' => $request['title'],
                'content' => $request['description'],
                'image' => $updateImage,
            ];

            $update = Article::where('id', $request['id'])->update($data);
            if($update){
                return true;
            }else{
                return false;
            }
        } catch (\Exception $e) {
            \Log::error($e->getMessage() . " " . $e->getFile() . " " . $e->getLine());
        }
    }


    public function articlesDelete($id){
        try {
            $delete = Article::where('id', $id)->first();
            if($delete->delete()){
                return true;
            }else{
                return false;
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


}