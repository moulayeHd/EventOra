<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Espace;
use App\Models\Programme;
use App\Models\Billet;

class Evenement extends Model
{
    protected $fillable = [
        'nom',
        'description',
        'date',
        'heure_debut',
        'heure_fin',
        'espace_id',
    ];

    public function espace()
    {
        return $this->belongsTo(Espace::class);
    }

    public function programmes()
    {
        return $this->hasMany(Programme::class);
    }

    public function billets()
    {
        return $this->hasMany(Billet::class);
    }
}
