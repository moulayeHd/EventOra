<?php

namespace App\Http\Controllers;

use App\Models\Billet;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['billet.evenement.espace'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        if (view()->exists('reservations.index')) {
            return view('reservations.index', compact('reservations'));
        }

        return response()->json($reservations);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'billet_id' => ['required', 'exists:billets,id'],
            'quantite' => ['required', 'integer', 'min:1'],
        ]);

        $reservation = DB::transaction(function () use ($validated) {
            $billet = Billet::whereKey($validated['billet_id'])
                ->lockForUpdate()
                ->firstOrFail();

            if ($billet->quantite < $validated['quantite']) {
                abort(422, 'Quantite de billets insuffisante.');
            }

            $billet->decrement('quantite', $validated['quantite']);

            return Reservation::create([
                'user_id' => auth()->id(),
                'billet_id' => $billet->id,
                'quantite' => $validated['quantite'],
                'ticket_code' =>Reservation::generateTicketCode(),
            ]);
        });

        return redirect()
            ->route('billets.index')
            ->with('success', 'Achat valide. Votre billet QR est disponible.');
    }

    public function update(Request $request, Reservation $reservation)
    {
        if ($reservation->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'quantite' => ['required', 'integer', 'min:1'],
        ]);

        DB::transaction(function () use ($reservation, $validated) {
            $reservation = Reservation::whereKey($reservation->id)
                ->lockForUpdate()
                ->firstOrFail();

            $billet = Billet::whereKey($reservation->billet_id)
                ->lockForUpdate()
                ->firstOrFail();

            $ancienneQuantite = $reservation->quantite;
            $nouvelleQuantite = $validated['quantite'];
            $difference = $nouvelleQuantite - $ancienneQuantite;

            if ($difference > 0 && $billet->quantite < $difference) {
                abort(422, 'Quantite de billets insuffisante.');
            }

            if ($difference > 0) {
                $billet->decrement('quantite', $difference);
            }

            if ($difference < 0) {
                $billet->increment('quantite', abs($difference));
            }

            $reservation->update([
                'quantite' => $nouvelleQuantite,
            ]);
        });

        return redirect()
            ->route('reservations.index')
            ->with('success', 'Reservation modifiee avec succes.');
    }

    public function destroy(Reservation $reservation)
    {
        if ($reservation->user_id !== auth()->id()) {
            abort(403);
        }

        DB::transaction(function () use ($reservation) {
            $reservation = Reservation::whereKey($reservation->id)
                ->lockForUpdate()
                ->firstOrFail();

            $billet = Billet::whereKey($reservation->billet_id)
                ->lockForUpdate()
                ->firstOrFail();

            $billet->increment('quantite', $reservation->quantite);
            $reservation->delete();
        });

        return redirect()
            ->route('reservations.index')
            ->with('success', 'Reservation annulee avec succes.');
    }

   
}
