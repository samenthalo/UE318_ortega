<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biographie extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class); // ou Membre::class si c'est ton modèle
    }
}

