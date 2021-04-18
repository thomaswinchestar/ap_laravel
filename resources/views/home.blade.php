@extends('layout')

@section('content')
    <div class="container">
        <div>
            <a href="/posts/create" class="btn btn-success">New Post</a>
            <a href="/logout" class="btn btn-warning">Logout</a>
            <h4 style="float: right">{{Auth::user()->name}}</h4>
        </div>
        <br>
        @if (session('create'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('create') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @elseif(session('update'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Update!</strong> {{ session('update') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @elseif(session('delete'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Delete!</strong> {{ session('delete') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
            <div class="card-header" style="text-align: center">
                Contents
            </div>
            <div class="card-body">
                @foreach($data as $post)
                   <div>
                       <h5 class="card-title">{{ $post->name }}</h5>
                       <p class="card-text">{{ $post->description }}</p>
                       <a href="/posts/{{ $post->id }}" class="btn btn-primary">View</a>
                       <a href="/posts/{{ $post->id }}/edit" class="btn btn-warning">Edit</a>
                       <div class="btn btn-waring" style="padding: 0">
                           <form action="/posts/{{ $post->id }}" method="post">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-danger">Delete</button>
                           </form>
                       </div>
                   </div><hr>
                @endforeach
            </div>
        </div>
    </div>
@endsection
