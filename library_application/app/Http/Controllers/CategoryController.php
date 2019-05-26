<?php

namespace App\Http\Controllers;

use App\Category;
use App\Book;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $categories = Category::all();

        return view('books.collection', compact('categories'));
    }

    /**
     * show
     *
     * @param mixed $slug_cat
     * @return void
     */
    public function show($slug_cat)
    {
        $category = Category::where('slug', $slug_cat)->first();
        return view('books.category',compact('category'));
    }
}
