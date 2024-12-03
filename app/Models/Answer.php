<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public function question() //Ovom relacijom se opisuje da odgovor pripada nekom pitanju
    {
    return $this->belongsTo(Question::class);
    }
}
