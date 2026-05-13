<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Evenement;
use App\Models\Reservation;

class Billet extends Model
{
    protected $fillable = [
        'type',
        'prix',
        'quantite',
        'evenement_id',
    ];

    public function evenement()
    {
        return $this->belongsTo(Evenement::class);
    }
    
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
