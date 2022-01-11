<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return view('/categories',[
            'title' => 'Categories',
            'categories' => Category::all()
        ]);
    }

    public function category(Category $category)
    {
        $order = $category->posts;
        return view('/category', [
            'top_posts' => $order->sortByDesc('like'),
            'title' => $category->category,
            'posts' => $category->posts->load('user', 'category'),
            'gambar' => $category->gambar
        ]);
    }
}
