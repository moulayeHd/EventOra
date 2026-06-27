<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DemandeOrganisateur extends Model
{
    protected $table = 'demandes_organisateur';

    protected $fillable = [
        'user_id',
        'nom_groupe',
        'type_evenements',
        'telephone',
        'description',
        'statut',
        'message_refus',
    ];

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes pratiques pour filtrer par statut
    public function scopeEnAttente($query)
    {
        return $query->where('statut', 'en_attente');
    }

    public function scopeApprouve($query)
    {
        return $query->where('statut', 'approuve');
    }

    public function scopeRefuse($query)
    {
        return $query->where('statut', 'refuse');
    }

    // Helpers pour vérifier le statut
    public function estEnAttente(): bool
    {
        return $this->statut === 'en_attente';
    }

    public function estApprouve(): bool
    {
        return $this->statut === 'approuve';
    }

    public function estRefuse(): bool
    {
        return $this->statut === 'refuse';
    }
}