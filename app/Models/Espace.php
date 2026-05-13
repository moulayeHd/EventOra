<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Evenement;

class Espace extends Model
{
    protected $fillable = [
        'nom',
        'localisation',
        'capacite',
    ];

    public function evenements()
    {
        return $this->hasMany(Evenement::class);
    }
}
