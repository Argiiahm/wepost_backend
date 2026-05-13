<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $table = "posts";
    protected $fillable = ["title", "content", "user_id", "category_id"];

    // user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // category
    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    // likes
    public function likes()
    {
        return $this->hasMany(Like::class, "post_id");
    }
}
