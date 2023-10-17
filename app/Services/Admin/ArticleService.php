<?php

namespace App\Services\Admin;

use App\Services\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Article;
use Auth;

class ArticleService extends Service
{
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
}