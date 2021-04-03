@extends('layout')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header" style="text-align: center">
                New Post
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="/posts" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="exampleFormControlInput1" placeholder="Enter Name" value="{{ old('name') }}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3" placeholder="Enter Description" >{{ old('description') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Categories</label>
                        <select name="category_id" class="form-select" aria-label="Default select example">
                            <option value="">Choose the Category</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="/posts" class="btn btn-success">Back</a>
                </form>
            </div>
        </div>
    </div>
@endsection
