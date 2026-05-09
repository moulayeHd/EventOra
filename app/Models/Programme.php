<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Evenement;

class Programme extends Model
{
    protected $fillable = [
        'nom',
        'description',
        'evenement_id',
    ];

    public function evenement()
    {
        return $this->belongsTo(Evenement::class);
    }
}
