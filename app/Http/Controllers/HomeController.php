<?php

namespace App\Http\Controllers;

use App\Events\PostCreatedEvent;
use App\Models\User;
use App\Test;
use App\Models\Post;
use App\Mail\PostStored;
use App\Models\Category;
use App\Mail\PostCreated;
use App\Mail\PostDeleted;
use App\Mail\PostUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\storePostRequest;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PostCreatedNotification;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $user = User::find(66);
        // $user->notify(new PostCreatedNotification());
        // Notification::send(User::find(66), new PostCreatedNotification());
        $data = Post::where('user_id', auth()->id())->orderBy('id', 'desc')->get();
//        $request->session()->flash('status', 'Login successfully!');
        return view('home', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(storePostRequest $request)
    {
        $validated = $request->validated();
        $post = Post::create($validated + ['user_id' => Auth::user()->id]);
        event(new PostCreatedEvent($post));
//        Mail::to('hlaing@gmail.com')->send(new PostCreated());
//        Mail::to('hlaing@gmail.com')->send(new PostStored($post));
        return redirect('/posts')->with('create', config('aprogrammer.message.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

//        if($post->user_id !== auth()->id()){
//            abort(403);
//        }
        $this->authorize('view', $post);
        return view('show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
//        if($post->user_id !== auth()->id()){
//            abort(403);
//        }
        $this->authorize('view', $post);
        $categories = Category::all();
        return view('edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(storePostRequest $request, Post $post)
    {
        $validated = $request->validated();
        $post->update($validated);
//        Mail::to('hlaing@gmail.com')->send(new PostUpdated($post));
        return redirect('/posts')->with('update', config('aprogrammer.message.updated'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
//       Mail::to('hlaing@gmail.com')->send(new PostDeleted($post));
        return redirect(('/posts'))->with('delete', config('aprogrammer.message.deleted'));
    }
}
