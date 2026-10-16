<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $table = 'complaints';

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'image_path',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
