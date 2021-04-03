@extends('layout')

@section('content')
    <div class="container">
        <div>
            <a href="/posts/create" class="btn btn-success">New Post</a>
            <a href="logout" class="btn btn-warning">Logout</a>
        </div>
        <br>
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
