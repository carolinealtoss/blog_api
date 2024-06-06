<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'comment',
    ];

    public static function validate($data)
    {
        return Validator::make($data, [
            'user_id' => 'required|exists:users,id',
            'comment' => 'required|string|max:1000'
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class());
    }
}
