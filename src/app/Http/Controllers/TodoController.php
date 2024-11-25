<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Category;
use App\Http\Requests\TodoRequest;
use App\Http\Controllers\CategoryController;


class TodoController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $todos = Todo::all();

        return view('index',compact('todos','categories'));
    }

    public function store(TodoRequest $request)
    {
        $todo = $request->only(['content', 'category_id']);
        Todo::create([
        'content' => $request->content,
        'category_id' => $request->category_id,
        ]);

        return redirect('/')->with('message','Todoを作成しました');
    }

    public function update(TodoRequest $request)
    {
        $todo = $request->only(['content']);
        Todo::find($request->id)->update($todo);

        return redirect('/')->with('message','Todoを更新しました');
    }

    public function destroy(Request $request)
    {
        Todo::find($request->id)->delete();
        return redirect('/')->with('message','Todoを削除しました');
    }

}
