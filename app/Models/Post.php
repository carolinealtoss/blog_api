<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'image',
        'title',
        'slug',
        'text',
    ];

    public static function validate($data)
    {
        return Validator::make($data, [
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'text' => 'required|string|max:255',
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
