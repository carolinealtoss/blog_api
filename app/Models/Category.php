<?php

namespace App\Models;

use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_name'
    ];

    public static function validate($data)
    {
        return Validator::make($data, [
            'user_id' => 'required|exists:users,id',
            'category_name' => 'required|string|max:255',
        ]);
    }

    // obtém o usuário relacionado a categoria
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
