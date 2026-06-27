<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Billet;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'billet_id',
        'quantite',
        'ticket_code',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function billet()
    {
        return $this->belongsTo(Billet::class);
    }

    public static function generateTicketCode(): string
    {
      do {
          $code = 'EVT-'.now()->format('ymd').'-'.Str::upper(Str::random(8));
         } while (self::where('ticket_code', $code)->exists());

       return $code;
    }
}
