<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register()
    {
        return view('auth.register');
    }
    public function registerPost(Request $request)
    {
        $request->validate([
            'name'=> 'required|min:3|max:100|',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:8|max:32|confirmed',
            'password_confirmation' => 'required|min:8|max:32|same:password',

        ]);
         $pss= $request->password;
        User::create([
            'name'=> $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ]);

        return redirect('/');
    }
    public function login()
    {
        return view('auth.login');
    }
    public function loginPost(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:8|max:32',
        ]);
        if(Auth::attempt($credentials))
        {
            return redirect('/');
        }
        return redirect()->back()->with('error', 'Invalid credentials');

    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function Dashboard()
    {

        $todos = Todo::paginate();
        $categories = Category::all();
        $password = Auth::user()->password;
        return view('auth.dashboard', compact('todos','categories','password'));
    }
}
