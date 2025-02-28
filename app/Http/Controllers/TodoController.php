<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Todo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Morilog\Jalali\Jalalian;

class TodoController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('todos.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'image' => 'required|max:2000|image',
            'title' => 'required|min:5',
            'description' => 'required|min:3',
            'category_id' => 'required|integer',

        ]);
        // dd($request->deadtime);


        $filename = time() . '_' . $request->image->getClientOriginalName();
        $request->image->storeAs('/images', $filename);

        $dueDate = $request->input('due_date'); // تاریخ شمسی از اینپوت
        // تبدیل تاریخ شمسی به میلادی
        $gregorianDate = Jalalian::fromFormat('Y/m/d H:i', $dueDate)->toCarbon();
        
        Todo::create([
            'image' => $filename,
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'user_id' => Auth::user()->id,
            'deadtime'=>$gregorianDate
        ]);

        return redirect()->route('dashboard');
    }
    public function index()
    {
        $todos = Todo::paginate(2);
        // $position = strpos(, ' ');
        return view('auth.dashboard', compact('todos'));
    }
    public function show(todo $todo)
    {
        $todos =Todo::all();
        return view('todos.show', compact('todo'));
    }
    public function completed(todo $todo)
    {
        $todo->update([
            'status'=>1,
        ]);
        return redirect()->route('dashboard');
    }
    public function edit(Todo $todo)
    {
        $categories = Category::all();
        $jalaliDueDate = Jalalian::fromDateTime($todo->due_date)->format('Y/m/d H:i');

        return view('todos.edit', compact('todo','categories','jalaliDueDate'));
    }
    public function update(Request $request , todo $todo)
    {
        $request->validate([
            'image' => 'nullable|max:2000|image',
            'title' => 'required|min:5',
            'description' => 'required|min:5',
        ]);
        if($request->hasFile('image')){
            Storage::delete('/images/'.$todo->image);
            $filename = time() . '_' . $request->image->getClientOriginalName();
            $request->image->storeAs('/images', $filename);
        }
        $todo->update([
            'image'=>$request->hasFile('image')?$filename:$todo->image,
            'title'=>$request->title,
            'description'=>$request->description,
        ]);
        return redirect()->route('todo.show', ['todo' => $todo->id]);
    }
    public function destroy(todo $todo)
    {
        // dd(!!$todo->category->title);

        Storage::delete('/images/'.$todo->image);
        $todo->delete();
        return redirect()->route('dashboard');

    }
}
