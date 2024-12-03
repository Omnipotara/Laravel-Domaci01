<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function answers() //Ovom relacijom se definise da pitanje moze imati vise odgovora
    {
    return $this->hasMany(Answer::class);
    }
}
