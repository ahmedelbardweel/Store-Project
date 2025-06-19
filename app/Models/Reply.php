<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = ['review_id', 'user_id', 'reply'];

    // علاقة: الرد يتبع تعليق
    public function review()
    {
        return $this->belongsTo(Review::class);
    }

    // علاقة: الرد يتبع مستخدم (الأدمن غالباً)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies() {
        return $this->hasMany(Reply::class);
    }


}
