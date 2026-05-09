<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Billet;

class Reservation extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'evenement_id',
        'billet_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function billet()
    {
        return $this->belongsTo(Billet::class);
    }
}
