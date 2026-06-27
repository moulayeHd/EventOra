<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    public const ROLE_UTILISATEUR = 'utilisateur';
    public const ROLE_ORGANISATEUR = 'organisateur';
    public const ROLE_ADMINISTRATEUR = 'administrateur';
    public const ROLE_EN_ATTENTE = 'organisateur_en_attente'; 

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function demandes(): HasMany
    {
        return $this->hasMany(DemandeOrganisateur::class);
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    public function hasRole(string|array $roles): bool
    {
        return in_array($this->role, (array) $roles, true);
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMINISTRATEUR;
    }

    public function isOrganisateur(): bool
    {
        return $this->role === self::ROLE_ORGANISATEUR;
    }

    public function isEnAttente(): bool
    {
        return $this->role === self::ROLE_EN_ATTENTE;
    }

    public function isUtilisateur(): bool
    {
        return $this->role === self::ROLE_UTILISATEUR;
    }

    // Nombre de notifications non lues
    public function notificationsNonLues(): int
    {
        return $this->notifications()->where('lu', false)->count();
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}