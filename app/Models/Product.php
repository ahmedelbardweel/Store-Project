<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'slug',
        'price',
        'img',    // ↩ هنا تأكد من وجود Img
    ];
    public function reviews()
    {
        return $this->hasMany(\App\Models\Review::class);
    }
    public function replies()
    {
        return $this->hasMany(\App\Models\Reply::class);
    }




}
