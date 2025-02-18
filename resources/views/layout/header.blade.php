<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Authentication || webprog.io</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
        <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/persian-datepicker/dist/css/persian-datepicker.min.css">

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/persian-date@1.1.0/dist/persian-date.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/persian-datepicker/dist/js/persian-datepicker.min.js"></script>
</head>

<body>
    <div class="container-fluid ">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <a class="navbar-brand" href="{{ route('home') }}">Auth App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        {{-- <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a> --}}
                    </li>
                    <li class="nav-item">
                        {{-- <a class="nav-link" href="{{route('todo.index')}}">Todos</a> --}}
                    </li>
                </ul>
                <div class="d-flex">
                    @auth
                    {{-- <p class="navbar-brand mt-3">hello {{auth()->user()->name}}</p> --}}
                    <form action="{{route('dashboard', ['userId'])}}">
                        @csrf
                        <input type="hidden" value="{{auth()->user()->id}}" name="userId">
                    <button class="btn btn-sm btn-secondary ms-2">{{auth()->user()->name}}'s Dashboard</button>
                    </form>
                    <form action="{{route('logout')}}" method="Post">
                        @csrf
                        <button class="btn btn-sm btn-secondary ms-2">logout</button>
                    </form>

                    @endauth
                    @guest

                    <a href="{{route('login')}}" class="btn btn-sm btn-outline-dark">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-sm btn-secondary ms-2">Register</a>
                    @endguest

                </div>
            </div>
        </div>
    </nav>
