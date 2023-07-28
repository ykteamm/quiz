<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'question_id',
        'type',
        'input',
        'select',
        'checkbox',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }


}
