<?php

namespace App\Http\Controllers;

use App\Models\Billet;
use App\Models\Evenement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function index()
    {
        $events = Evenement::with(['espace', 'programmes', 'billets'])
            ->orderBy('date')
            ->paginate(12);

        return view('events', compact('events'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'nom'             => ['required', 'string', 'max:255'],
        'description'     => ['required', 'string'],
        'image'           => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        'date'            => ['required', 'date', 'after:today'],
        'heure_debut'     => ['required', 'date_format:H:i'],
        'heure_fin'       => ['required', 'date_format:H:i', 'after:heure_debut'],
        'espace_id'       => ['required', 'exists:espaces,id'],
        'billets'         => ['required', 'array', 'min:1'],
        'billets.*.type'  => ['required', 'string', 'max:100'],
        'billets.*.prix'  => ['required', 'numeric', 'min:0'],
        'billets.*.quantite' => ['required', 'integer', 'min:1'],
    ]);

    // ─── Vérification conflit de lieu ──────────────────
    $conflit = $this->detecterConflit(
        $validated['espace_id'],
        $validated['date'],
        $validated['heure_debut'],
        $validated['heure_fin']
    );

    if ($conflit) {
        return back()
            ->withErrors([
                'espace_id' => 'Ce lieu est déjà réservé le ' .
                    \Carbon\Carbon::parse($validated['date'])->format('d/m/Y') .
                    ' de ' . $conflit->heure_debut . ' à ' . $conflit->heure_fin .
                    ' par l\'événement "' . $conflit->nom . '".' .
                    ' Veuillez choisir un autre lieu ou modifier les horaires.'
            ])
            ->withInput();
    }

    $eventData = collect($validated)
        ->only(['nom', 'description', 'date', 'heure_debut', 'heure_fin', 'espace_id'])
        ->all();

    $eventData['user_id'] = auth()->id();

    if ($request->hasFile('image')) {
        $eventData['image_path'] = $request->file('image')->store('events', 'public');
    }

    $event = DB::transaction(function () use ($eventData, $validated) {
        $event = Evenement::create($eventData);

        // Créer tous les types de billets
        foreach ($validated['billets'] as $billet) {
            Billet::create([
                'evenement_id' => $event->id,
                'type'         => $billet['type'],
                'prix'         => $billet['prix'],
                'quantite'     => $billet['quantite'],
            ]);
        }

        return $event;
    });

    if ($request->input('source') === 'organizer') {
        return redirect()
            ->route('organisateur')
            ->with('success', 'Evenement cree avec succes.');
    }

    if ($request->input('source') === 'admin') {
        return redirect(route('admin.dashboard') . '#events')
            ->with('success', 'Evenement cree avec succes.');
    }

    return redirect()
        ->route('event.details', $event)
        ->with('success', 'Evenement cree avec succes.');
}

    public function show(Evenement $event)
    {
        $event->load(['espace', 'programmes', 'billets']);

        return view('event-details', compact('event'));
    }

    public function update(Request $request, Evenement $event)
    {
        $this->authorizeEventManagement($event);

        $validated = $request->validate([
            'nom'         => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'date'        => ['required', 'date', 'after:today'],
            'heure_debut' => ['required', 'date_format:H:i'],
            'heure_fin'   => ['required', 'date_format:H:i', 'after:heure_debut'],
            'espace_id'   => ['required', 'exists:espaces,id'],
        ]);

        // ─── Vérification conflit (en excluant l'événement actuel) ──
        $conflit = $this->detecterConflit(
            $validated['espace_id'],
            $validated['date'],
            $validated['heure_debut'],
            $validated['heure_fin'],
            $event->id // ← exclure l'événement qu'on est en train de modifier
        );

        if ($conflit) {
            return back()
                ->withErrors([
                    'espace_id' => 'Ce lieu est déjà réservé le ' .
                        \Carbon\Carbon::parse($validated['date'])->format('d/m/Y') .
                        ' de ' . $conflit->heure_debut . ' à ' . $conflit->heure_fin .
                        ' par l\'événement "' . $conflit->nom . '".' .
                        ' Veuillez choisir un autre lieu ou modifier les horaires.'
                ])
                ->withInput();
        }

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('events', 'public');
        }

        $event->update($validated);

        return redirect()
            ->route('event.details', $event)
            ->with('success', 'Evenement modifie avec succes.');
    }

    public function destroy(Request $request, Evenement $event)
    {
        $this->authorizeEventManagement($event);

        $event->delete();

        if ($request->input('source') === 'organizer') {
            return redirect()
                ->route('organisateur')
                ->with('success', 'Evenement supprime avec succes.');
        }

        if ($request->input('source') === 'admin') {
            return redirect(route('admin.dashboard') . '#events')
                ->with('success', 'Evenement supprime avec succes.');
        }

        return redirect()
            ->route('events')
            ->with('success', 'Evenement supprime avec succes.');
    }

    // ─── Méthode privée : détecter un conflit ──────────────
    private function detecterConflit(
        int $espaceId,
        string $date,
        string $heureDebut,
        string $heureFin,
        ?int $exclureEventId = null
    ): ?Evenement {
        return Evenement::where('espace_id', $espaceId)
            ->where('date', $date)
            ->where(function ($query) use ($heureDebut, $heureFin) {
                $query->where(function ($q) use ($heureDebut, $heureFin) {
                    $q->where('heure_debut', '<', $heureFin)
                      ->where('heure_fin', '>', $heureDebut);
                });
            })
            ->when($exclureEventId, function ($query) use ($exclureEventId) {
                $query->where('id', '!=', $exclureEventId);
            })
            ->first();
    }

    private function authorizeEventManagement(Evenement $event): void
    {
        $user = auth()->user();

        if (! $user || (! $user->isAdmin() && $event->user_id !== $user->id)) {
            abort(403, 'Vous ne pouvez pas gerer cet evenement.');
        }
    }
}