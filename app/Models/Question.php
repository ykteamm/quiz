<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'question',
        'sort',
        'link',
    ];

    protected $casts = [
        'link' => 'array',
    ];

    public function select()
    {
        return $this->hasOne(SelectQuestion::class);
    }

    public function category()
    {
        return $this->belongsTo(CategoryQuestion::class);
    }

}
