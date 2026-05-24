<?php

namespace App\Http\Controllers;

use App\Models\Billet;
use App\Models\Evenement;
use App\Models\Espace;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        $admin = auth()->user();

        $roleStats = User::selectRaw('role, count(*) as total')
            ->groupBy('role')
            ->pluck('total', 'role');

        $events = Evenement::with(['organisateur', 'espace'])
            ->withCount('reservations')
            ->orderByDesc('date')
            ->get();

        $users = User::latest()
            ->get();

        $espaces = Espace::withCount('evenements')
            ->orderBy('nom')
            ->get();

        $reservations = Reservation::with(['user', 'billet.evenement'])
            ->latest()
            ->get();

        $eventRows = $events->map(function (Evenement $event) use ($reservations) {
            $eventReservations = $reservations->filter(
                fn (Reservation $reservation) => $reservation->billet?->evenement_id === $event->id
            );

            return [
                'model' => $event,
                'name' => $event->nom,
                'organizer' => $event->organisateur?->name ?? 'Non assigne',
                'location' => $event->espace?->localisation ?? $event->espace?->nom ?? 'Lieu non defini',
                'date' => Carbon::parse($event->date),
                'reservations' => $event->reservations_count,
                'tickets_sold' => $eventReservations->sum('quantite'),
                'revenue' => $eventReservations->sum(
                    fn (Reservation $reservation) => $reservation->quantite * (float) ($reservation->billet?->prix ?? 0)
                ),
            ];
        });

        $ticketsSold = $reservations->sum('quantite');
        $revenue = $reservations->sum(
            fn (Reservation $reservation) => $reservation->quantite * (float) ($reservation->billet?->prix ?? 0)
        );
        $upcomingEvents = $eventRows
            ->filter(fn (array $row) => $row['date']->isFuture() || $row['date']->isToday())
            ->sortBy('date')
            ->take(5)
            ->values();

        if ($upcomingEvents->isEmpty()) {
            $upcomingEvents = $eventRows->sortByDesc('date')->take(5)->values();
        }

        return view('admin.dashboard', [
            'admin' => $admin,
            'stats' => [
                'users' => User::count(),
                'organisateurs' => $roleStats[User::ROLE_ORGANISATEUR] ?? 0,
                'administrateurs' => $roleStats[User::ROLE_ADMINISTRATEUR] ?? 0,
                'utilisateurs' => $roleStats[User::ROLE_UTILISATEUR] ?? 0,
                'events' => Evenement::count(),
                'billets' => Billet::count(),
                'reservations' => Reservation::count(),
                'tickets_sold' => $ticketsSold,
                'revenue' => $revenue,
            ],
            'users' => $users,
            'recentUsers' => $users->take(5),
            'eventRows' => $eventRows,
            'upcomingEvents' => $upcomingEvents,
            'espaces' => $espaces,
        ]);
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', Rule::in([
                User::ROLE_UTILISATEUR,
                User::ROLE_ORGANISATEUR,
                User::ROLE_ADMINISTRATEUR,
            ])],
        ]);

        User::create($validated);

        return redirect(route('admin.dashboard').'#users')
            ->with('success', 'Utilisateur cree avec succes.');
    }

    public function destroyUser(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect(route('admin.dashboard').'#users')
                ->withErrors(['user' => 'Vous ne pouvez pas supprimer votre propre compte.']);
        }

        $user->delete();

        return redirect(route('admin.dashboard').'#users')
            ->with('success', 'Utilisateur supprime avec succes.');
    }

    public function storeVenue(Request $request)
    {
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'localisation' => ['required', 'string', 'max:255'],
            'capacite' => ['required', 'integer', 'min:1'],
        ]);

        Espace::create($validated);

        return redirect(route('admin.dashboard').'#settings')
            ->with('success', 'Lieu ajoute avec succes.');
    }

    public function destroyVenue(Espace $espace)
    {
        if ($espace->evenements()->exists()) {
            return redirect(route('admin.dashboard').'#settings')
                ->withErrors(['espace' => 'Ce lieu contient deja des evenements.']);
        }

        $espace->delete();

        return redirect(route('admin.dashboard').'#settings')
            ->with('success', 'Lieu supprime avec succes.');
    }
}
