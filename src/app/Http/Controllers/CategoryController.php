<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Todo;
use App\Http\Requests\TodoRequest;

class CategoryController extends Controller
{
    public function categories()
    {
        $todos = Todo::all();
        $categories = Category::all();
        return view('category',compact('categories','todos'));
    }

}
