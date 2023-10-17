<?php

namespace App\Services\Admin;

use App\Services\Service;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Auth;

class CategoryService extends Service
{
    public function category(){
        try {
            $category = Category::orderBy('id', 'desc')->get();
            return $category;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function categoryAll(){
        try {
            $category = Category::orderBy('id', 'desc')->paginate(10, ['*'], 'categorries');
            return $category;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function categoryStore($request){
        try {
            $data = new Category();
            $data->user_id = Auth::user()->id;
            $data->title = $request['title'];
            $data->description = $request['description'];

            if($data->save()){
                return true;
            }else{
                return false;
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function categoryView($id){
        try {
            $data = Category::where('id', $id)->first();
            return $data;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function categoryUpdate($request){
        try {
            $data = [
                'user_id'       => Auth::user()->id,
                'title'         => $request['title'],
                'description'   => $request['description'],
            ];
            
            $update = Category::where('id', $request['id'])->update($data);
            if($update){
                return true;
            }else{
                return false;
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function categoryDelete($id){
        try {
            $data = Category::where('id', $id)->first();
            if($data->delete()){
                return true;
            }else{
                return false;
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}