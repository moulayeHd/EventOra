<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Evenement;

class Programme extends Model
{
    protected $fillable = [
        'titre',
        'description',
        'heure',
        'evenement_id',
    ];

    public function evenement()
    {
        return $this->belongsTo(Evenement::class);
    }
}
