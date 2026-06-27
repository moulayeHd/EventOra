<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'titre',
        'message',
        'type',
        'lu',
    ];

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopeNonLu($query)
    {
        return $query->where('lu', false);
    }

    public function scopeLu($query)
    {
        return $query->where('lu', true);
    }

    // Helpers
    public function estLu(): bool
    {
        return $this->lu === true;
    }

    public function marquerCommeLu(): void
    {
        $this->update(['lu' => true]);
    }
}