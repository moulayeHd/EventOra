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
            ->get();

        return view('events', compact('events'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'date' => ['required', 'date'],
            'heure_debut' => ['required', 'date_format:H:i'],
            'heure_fin' => ['required', 'date_format:H:i', 'after:heure_debut'],
            'espace_id' => ['required', 'exists:espaces,id'],
            'ticket_type' => ['required', 'string', 'max:100'],
            'ticket_price' => ['required', 'numeric', 'min:0'],
            'ticket_quantity' => ['required', 'integer', 'min:1'],
        ]);

        $eventData = collect($validated)
            ->only(['nom', 'description', 'date', 'heure_debut', 'heure_fin', 'espace_id'])
            ->all();

        $eventData['user_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $eventData['image_path'] = $request->file('image')->store('events', 'public');
        }

        $event = DB::transaction(function () use ($eventData, $validated) {
            $event = Evenement::create($eventData);

            Billet::create([
                'evenement_id' => $event->id,
                'type' => $validated['ticket_type'],
                'prix' => $validated['ticket_price'],
                'quantite' => $validated['ticket_quantity'],
            ]);

            return $event;
        });

        if ($request->input('source') === 'organizer') {
            return redirect()
                ->route('organisateur')
                ->with('success', 'Evenement cree avec succes.');
        }

        if ($request->input('source') === 'admin') {
            return redirect(route('admin.dashboard').'#events')
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
            'nom' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'date' => ['required', 'date'],
            'heure_debut' => ['required', 'date_format:H:i'],
            'heure_fin' => ['required', 'date_format:H:i', 'after:heure_debut'],
            'espace_id' => ['required', 'exists:espaces,id'],
        ]);

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
            return redirect(route('admin.dashboard').'#events')
                ->with('success', 'Evenement supprime avec succes.');
        }

        return redirect()
            ->route('events')
            ->with('success', 'Evenement supprime avec succes.');
    }

    private function authorizeEventManagement(Evenement $event): void
    {
        $user = auth()->user();

        if (! $user || (! $user->isAdmin() && $event->user_id !== $user->id)) {
            abort(403, 'Vous ne pouvez pas gerer cet evenement.');
        }
    }
}
