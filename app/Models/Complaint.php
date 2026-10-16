<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\User;

class Complaint extends Model
{
    protected $table = 'complaints';

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'image_path',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
