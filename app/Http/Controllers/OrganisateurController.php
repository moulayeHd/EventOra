<?php

namespace App\Http\Controllers;

use App\Models\Billet;
use App\Models\Evenement;
use App\Models\Espace;
use App\Models\Reservation;
use Illuminate\Support\Carbon;

class OrganisateurController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $events = Evenement::with(['espace', 'billets'])
            ->withCount('reservations')
            ->where('user_id', $user->id)
            ->orderByDesc('date')
            ->get();

        $eventIds = $events->pluck('id');

        $reservations = Reservation::with(['user', 'billet.evenement.espace'])
            ->whereHas('billet', function ($query) use ($eventIds) {
                $query->whereIn('evenement_id', $eventIds);
            })
            ->latest()
            ->get();

        $ticketTiers = Billet::with('evenement')
            ->whereIn('evenement_id', $eventIds)
            ->get()
            ->map(function (Billet $billet) use ($reservations) {
                $sold = $reservations
                    ->where('billet_id', $billet->id)
                    ->sum('quantite');
                $capacity = max(0, $sold + (int) $billet->quantite);

                return [
                    'id' => $billet->id,
                    'type' => $billet->type,
                    'event' => $billet->evenement?->nom ?? 'Evenement',
                    'price' => (float) $billet->prix,
                    'available' => (int) $billet->quantite,
                    'sold' => $sold,
                    'capacity' => $capacity,
                    'percentage' => $capacity > 0 ? min(100, round(($sold / $capacity) * 100)) : 0,
                    'revenue' => $sold * (float) $billet->prix,
                ];
            });

        $eventRows = $events->map(function (Evenement $event) use ($reservations) {
            $eventReservations = $reservations->filter(
                fn (Reservation $reservation) => $reservation->billet?->evenement_id === $event->id
            );
            $sold = $eventReservations->sum('quantite');
            $available = $event->billets->sum('quantite');
            $capacity = max(0, $sold + $available);
            $revenue = $eventReservations->sum(
                fn (Reservation $reservation) => $reservation->quantite * (float) ($reservation->billet?->prix ?? 0)
            );

            return [
                'model' => $event,
                'name' => $event->nom,
                'location' => $event->espace?->nom ?? 'Lieu non defini',
                'date' => Carbon::parse($event->date),
                'status' => $this->eventStatus($event),
                'sold' => $sold,
                'capacity' => $capacity,
                'percentage' => $capacity > 0 ? min(100, round(($sold / $capacity) * 100)) : 0,
                'revenue' => $revenue,
            ];
        });

        $participants = $reservations
            ->whereNotNull('user_id')
            ->groupBy('user_id')
            ->map(function ($items) {
                $latest = $items->sortByDesc('created_at')->first();
                $participant = $latest->user;

                return [
                    'name' => $participant?->name ?? 'Participant',
                    'email' => $participant?->email ?? 'email@eventora.local',
                    'initials' => $this->initials($participant?->name),
                    'event' => $latest->billet?->evenement?->nom ?? 'Evenement',
                    'tier' => $latest->billet?->type ?? 'Standard',
                    'quantity' => $items->sum('quantite'),
                    'registered_at' => $latest->created_at,
                ];
            })
            ->values();

        $espaces = Espace::orderBy('nom')->get();

        $venues = $espaces->map(function (Espace $espace) use ($events, $reservations) {
            $venueEvents = $events->where('espace_id', $espace->id);
            $venueEventIds = $venueEvents->pluck('id');
            $sold = $reservations->filter(
                fn (Reservation $reservation) => $venueEventIds->contains($reservation->billet?->evenement_id)
            )->sum('quantite');
            $capacity = max(1, (int) $espace->capacite);

            return [
                'name' => $espace->nom,
                'location' => $espace->localisation,
                'capacity' => $espace->capacite,
                'events_count' => $venueEvents->count(),
                'utilization' => min(100, round(($sold / $capacity) * 100)),
            ];
        });

        $totalRevenue = $reservations->sum(
            fn (Reservation $reservation) => $reservation->quantite * (float) ($reservation->billet?->prix ?? 0)
        );
        $ticketsSold = $reservations->sum('quantite');
        $availableTickets = $ticketTiers->sum('available');
        $conversion = ($ticketsSold + $availableTickets) > 0
            ? round(($ticketsSold / ($ticketsSold + $availableTickets)) * 100, 1)
            : 0;
        $averageOrder = $reservations->count() > 0 ? $totalRevenue / $reservations->count() : 0;

        $revenueTrend = collect(range(5, 0))->map(function (int $offset) use ($reservations) {
            $month = now()->subMonths($offset);
            $value = $reservations
                ->filter(fn (Reservation $reservation) => $reservation->created_at?->isSameMonth($month))
                ->sum(fn (Reservation $reservation) => $reservation->quantite * (float) ($reservation->billet?->prix ?? 0));

            return [
                'label' => $month->translatedFormat('M'),
                'value' => round($value),
            ];
        });

        $ticketMix = $ticketTiers
            ->groupBy('type')
            ->map(fn ($items, string $type) => [
                'type' => $type,
                'sold' => $items->sum('sold'),
                'revenue' => $items->sum('revenue'),
            ])
            ->sortByDesc('sold')
            ->take(4)
            ->values();

        $recentRegistrations = $reservations
            ->take(6)
            ->map(fn (Reservation $reservation) => [
                'name' => $reservation->user?->name ?? 'Participant',
                'initials' => $this->initials($reservation->user?->name),
                'event' => $reservation->billet?->evenement?->nom ?? 'Evenement',
                'tier' => $reservation->billet?->type ?? 'Standard',
                'time' => $reservation->created_at?->diffForHumans() ?? 'recent',
            ]);

        $stats = [
            'events' => $events->count(),
            'live_events' => $eventRows->filter(fn (array $row) => $row['status']['key'] === 'live')->count(),
            'reservations' => $reservations->count(),
            'tickets_sold' => $ticketsSold,
            'available_tickets' => $availableTickets,
            'participants' => $participants->count(),
            'revenue' => $totalRevenue,
            'conversion' => $conversion,
            'average_order' => $averageOrder,
            'venues' => $venues->where('events_count', '>', 0)->count(),
        ];

        // ─── Calendrier de disponibilité ───────────────────────
$tousLesEspaces = Espace::orderBy('nom')->get();

$evenementsParEspace = Evenement::with('espace')
    ->whereIn('espace_id', $tousLesEspaces->pluck('id'))
    ->get()
    ->groupBy('espace_id');

return view('organizer.dashboard', [
    'user' => $user,
    'events' => $events,
    'eventRows' => $eventRows,
    'espaces' => $espaces,
    'reservations' => $reservations,
    'ticketTiers' => $ticketTiers,
    'participants' => $participants,
    'venues' => $venues,
    'revenueTrend' => $revenueTrend,
    'ticketMix' => $ticketMix,
    'recentRegistrations' => $recentRegistrations,
    'stats' => $stats,
    'tousLesEspaces' => $tousLesEspaces,          // ← NOUVEAU
    'evenementsParEspace' => $evenementsParEspace, // ← NOUVEAU
]);
    }

    private function eventStatus(Evenement $event): array
    {
        if ($event->billets->isEmpty()) {
            return ['key' => 'draft', 'label' => 'Brouillon'];
        }

        $date = Carbon::parse($event->date);

        if ($date->isToday()) {
            return ['key' => 'live', 'label' => 'En direct'];
        }

        if ($date->isPast()) {
            return ['key' => 'ended', 'label' => 'Termine'];
        }

        return ['key' => 'upcoming', 'label' => 'A venir'];
    }

    private function initials(?string $name): string
    {
        $words = collect(preg_split('/\s+/', trim($name ?: 'Event Ora')))
            ->filter()
            ->take(2);

        return $words
            ->map(fn (string $word) => mb_substr($word, 0, 1))
            ->implode('');
    }
}
