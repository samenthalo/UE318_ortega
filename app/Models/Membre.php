<?php
// Membre.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membre extends Model
{
    // Relation avec la table biographies
    public function biographie()
    {
        return $this->hasOne(Biographie::class);
    }
}

