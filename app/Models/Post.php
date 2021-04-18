<?php

namespace App\Models;

use App\Mail\PostCreated;
use App\Mail\PostDeleted;
use App\Mail\PostStored;
use App\Mail\PostUpdated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Post extends Model
{
    use HasFactory;
//    protected $fillable = ['name','description'];
    protected $guarded = [];

    public function categories()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
    protected static function booted()
    {
        static::created(function ($post) {
            Mail::to('hlaing@gmail.com')->send(new PostStored($post));
        });
        static::updated(function ($post) {
            Mail::to('hlaing@gmail.com')->send(new PostUpdated($post));
        });
        static::deleted(function ($post) {
            Mail::to('hlaing@gmail.com')->send(new PostDeleted($post));
        });
    }
}
