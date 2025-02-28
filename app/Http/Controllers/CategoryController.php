<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Todo;
use Illuminate\Database\Console\Migrations\StatusCommand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create()
    {
        return view('categories.create');
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([

            'title' => 'required|min:5',
        ]);

        Category::create(['title' => $request->title, 'user_id' => Auth::user()->id]);
        return redirect()->route('dashboard');
    }
    public function index()
    {
        $categories =Category::where('user_id','=', Auth::user()->id);
        return view('auth.dashboard', compact('categories'));
    }
    public function edit( Category  $category )
    {
        return view('categories.edit', compact('category'));
    }
    public function update( Category  $category, Request $request )
    {
        // dd($request->all(), $category);
        $request->validate(['title' => 'required|min:5',]);
        $category->update(['title' => $request->title]);
        return redirect()->route('dashboard');
    }
    public function destroy( Category  $category )
    {
        // dd(vars: !($category->todos->all()));
        if(!($category->todos->all()))
        {
        $category->delete();
        return redirect()->route('dashboard');
        }
        else
        {
            return redirect()->back()->with('error', 'category has todo (first delete todo)');
        }
    }
}
