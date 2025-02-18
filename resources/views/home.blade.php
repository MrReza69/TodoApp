@extends('layout.master')

@section('content')
    <div class="col-12 col-md-10">
        <div class="card">
            @if (session()->has('error'))
                <div class="alert alert-danger">{{session('error')}}</div>
            @endif
            <div class="card-body text-center">
                @guest
                <h2 class="mb-4">Todo App || sheskiGroup</h2>

                <p>
                    to improve yout skills join us!
                </p>
                @endguest
                @auth
                <h2 class="mb-4">Todo App || {{auth()->user()->name}}</h2>
                <p>
                    thank U to choose us!
                </p>
                    <a href="{{route('dashboard')}}">Dashboard</a>
                @endauth
            </div>
        </div>
    </div>
@endsection
