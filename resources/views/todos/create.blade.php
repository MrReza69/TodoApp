@extends('layout.master')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="">Create Todo</h5>
            {{-- <a href="{{route('todo.index')}}" class="btn btn-dark">back</a> --}}
            <a href="{{ route('dashboard') }}" class="btn btn-dark">back</a>

        </div>
        <div class="card-body">
            <form action="{{ route('todo.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" class="form-control">
                    <div class="form-text text-danger">@error('image') {{ $message }} @enderror</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control">
                    <div class="form-text text-danger">@error('title') {{ $message }} @enderror</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select class="form-select" name="category_id">
                        @foreach ($categories as $category)
                        @if ($category->user_id == auth()->user()->id)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endif
                        @endforeach
                    </select>
                    <div class="form-text text-danger">@error('category_id') {{ $message }} @enderror</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="description" rows="3"></textarea>
                    <div class="form-text text-danger">@error('description') {{ $message }} @enderror</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Dead Time</label>
                    {{-- <input type="datetime-local" name="deadtime"> --}}
                    <input type="text" id="datetimepicker" name="due_date" placeholder="1403/05/06 ">
                    {{-- <input type="time" name="deadtimeTime"> --}}
                </div>
                <button type="submit" class="btn btn-secondary">Submit</button>
            </form>
        </div>
    </div>
@endsection
