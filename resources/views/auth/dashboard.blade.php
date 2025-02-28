@extends('layout.master')

@section('content')
    {{-- <div class="col-12 col-md-10">
        <div class="card">
            @if (session()->has('error'))
                <div class="alert alert-danger">{{session('error')}}</div>
            @endif

            <h2 class="mb-4">Dashboard || {{auth()->user()->name}}</h2>

            </div>
        </div>
    </div> --}}

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">



      <!-- Main Content -->
      <div class="col-md-9 main-content">
          <h2>Todos</h2>
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="">Todos</h5>
                <a href="{{ route('todo.create') }}" class="btn btn-dark">create</a>
            </div>
            <div class="card-body">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Action</th>
                            <th>DeadTime</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($todos as $todo)
                            @if ($todo->user_id == auth()->user()->id)
                            <tr>
                                <td>
                                    <img width="90" class="rounded" src="{{ asset('images/' . $todo->image) }}" alt="image">
                                </td>
                                <td>{{ $todo->title }}</td>
                                <td>{{ $todo->category->title }}</td>
                                <td>
                                    <a href="{{ route('todo.show', ['todo' => $todo->id]) }}"
                                        class="btn btn-sm btn-secondary">Show</a>
                                    @if ($todo->status)
                                        <button disabled class="btn btn-sm btn-outline-danger">Completed</button>
                                    @else
                                        <a href="{{ route('todo.completed', ['todo' => $todo->id]) }}" class="btn btn-sm btn-info">Done?</a>
                                    @endif
                                </td>
                                <td>
                                    {{-- {{$todo->deadtime}} --}}
                                    {{\Morilog\Jalali\Jalalian::fromDateTime($todo->deadtime)->format('Y/m/d H:i')}}

                                {{-- {{$todo->shamsi_deadtime}} --}}
                                </td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                {{$todos->links()}}

            </div>
        </div>
        <!-- Category Page -->
        <h2 class="mt-5">Categories</h2>
        <div class="card ">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="">Categories</h5>
                <a href="{{ route('category.create') }}" class="btn btn-dark">create</a>
            </div>
            <div class="card-body">
                @if (session()->has('error'))
                <div class="alert alert-danger">{{session('error')}}</div>
            @endif
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        @if ($category->user_id == auth()->user()->id)
                            <tr>
                                <td>{{ $category->title }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('category.edit', ['category' => $category->id]) }}" class="btn btn-sm btn-secondary">Edit</a>
                                    <form action="{{ route('category.destroy', ['category' => $category->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger ms-2">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- User Detail -->
        <div id="user-detail" class="mt-5">
          <h2>User Detail</h2>
          <div class="card">
            <div class="card-body">
              <p><strong>Name:</strong> {{Auth::user()->name}}</p>
              <p><strong>Email:</strong> {{auth()->user()->email}}</p>
              {{-- <p><strong>password:</strong> {{}}</p> --}}
            </div>
          </div>
        </div>

        <!-- Update User -->
        <!--
        <div id="update-user" class="mt-5">
          <h2>Update User</h2>
          <div class="card">
            <div class="card-body">
              <form id="updateUserForm">
                <div class="mb-3">
                  <label for="userName" class="form-label" >Name</label>
                  <input type="text" class="form-control" id="userName" value="{{Auth::user()->name}}">
                </div>
                <div class="mb-3">
                  <label for="userEmail" class="form-label">Email</label>
                  <input type="email" class="form-control" id="userEmail" value='{{Auth::user()->email}}'>
                </div>
                <div class="mb-3">
                    <label for="userPassword" class="form-label">Password</label>
                  <input type="password" class="form-control" id="userPassword" value='{{Auth::user()->password}}'>
                </div>
                <div class="mb-3">
                    <label for="userPasswordRepeat" class="form-label">Password confirm</label>
                  <input type="password" class="form-control" id="userPasswordRepeat" >
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
              </form>
            </div>
          </div>
        </div>
    -->
      </div>
    </div>
  </div>


  <!-- Bootstrap JS and dependencies -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
  <!-- Custom JS -->
  <script>
    // Todo List Functionality
    document.getElementById('todoForm').addEventListener('submit', function (e) {
      e.preventDefault();
      const todoInput = document.getElementById('todoInput');
      const todoList = document.getElementById('todoList');
      if (todoInput.value.trim() !== '') {
        const li = document.createElement('li');
        li.textContent = todoInput.value;
        todoList.appendChild(li);
        todoInput.value = '';
      }
    });

    // Category List Functionality
    document.getElementById('categoryForm').addEventListener('submit', function (e) {
      e.preventDefault();
      const categoryInput = document.getElementById('categoryInput');
      const categoryList = document.getElementById('categoryList');
      if (categoryInput.value.trim() !== '') {
        const li = document.createElement('li');
        li.textContent = categoryInput.value;
        categoryList.appendChild(li);
        categoryInput.value = '';
      }
    });

    // Update User Functionality
    document.getElementById('updateUserForm').addEventListener('submit', function (e) {
      e.preventDefault();
      const userName = document.getElementById('userName').value;
      const userEmail = document.getElementById('userEmail').value;
      const userRole = document.getElementById('userRole').value;
      alert(`User Updated:\nName: ${userName}\nEmail: ${userEmail}\nRole: ${userRole}`);
    });
  </script>

@endsection
