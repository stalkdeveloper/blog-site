<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Article;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::count();
        $article = Article::count();
        // $category = Category::count();
        $category = Category::orderBy('id', 'desc')->paginate(10, ['*'], 'categorries');
        return view('admin.dashboard.dashboard', compact('user', 'article', 'category'));
    }
}
