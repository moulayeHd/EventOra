<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Espace;
use App\Models\Programme;
use App\Models\Billet;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class Evenement extends Model
{
    protected $fillable = [
        'user_id',
        'nom',
        'description',
        'image_path',
        'date',
        'heure_debut',
        'heure_fin',
        'espace_id',
    ];

    public function imageUrl(string $fallback = 'images/image/IMAGE 1.png'): string
    {
        if ($this->image_path) {
            return Storage::url($this->image_path);
        }

        return asset($fallback);
    }

    public function espace()
    {
        return $this->belongsTo(Espace::class);
    }

    public function organisateur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function programmes()
    {
        return $this->hasMany(Programme::class);
    }

    public function billets()
    {
        return $this->hasMany(Billet::class);
    }

    public function reservations()
    {
        return $this->hasManyThrough(Reservation::class, Billet::class, 'evenement_id', 'billet_id');
    }
}
