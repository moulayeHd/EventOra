<?php

namespace App\Http\Controllers;

use App\Models\Reservation;


class BilletController extends Controller
{
    public function index()
    {
        $billets = Reservation::with(['billet.evenement.espace'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get()
            ->map(fn (Reservation $reservation) => $this->attachQrData($reservation));

        if (view()->exists('billets.index')) {
            return view('billets.index', compact('billets'));
        }

        return response()->json($billets);
    }

   public function verify(string $code)
{
    $reservation = Reservation::with(['user', 'billet.evenement.espace'])
        ->where('ticket_code', $code)
        ->firstOrFail();

    // Si déjà utilisé, on affiche quand même mais avec le statut
    $dejaUtilise = $reservation->utilise;

    // Marquer comme utilisé si c'est la première fois
    if (!$dejaUtilise) {
        $reservation->update([
            'utilise'    => true,
            'utilise_le' => now(),
        ]);
    }

    return view('billets.verify', compact('reservation', 'dejaUtilise'));
}

    private function attachQrData(Reservation $reservation): Reservation
    {
        if (! $reservation->ticket_code) {
            $reservation->forceFill([
                'ticket_code' => Reservation::generateTicketCode(),
            ])->save();
        }

        $reservation->verification_url = route('billets.verify', $reservation->ticket_code);
        $reservation->qr_code = 'https://quickchart.io/qr?size=220&text='.urlencode($reservation->verification_url);

        return $reservation;
    }

   
}
