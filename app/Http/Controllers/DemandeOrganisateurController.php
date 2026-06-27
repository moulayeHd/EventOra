<?php

namespace App\Http\Controllers;

use App\Models\DemandeOrganisateur;
use Illuminate\Http\Request;

class DemandeOrganisateurController extends Controller
{
    // Afficher le formulaire de demande
    public function create()
    {
        $user = auth()->user();

        // Récupérer la demande existante si elle existe
        $demande = DemandeOrganisateur::where('user_id', $user->id)
            ->latest()
            ->first();

        return view('demande-organisateur', compact('demande'));
    }

    // Soumettre ou mettre à jour la demande
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_groupe'      => ['required', 'string', 'max:255'],
            'type_evenements' => ['required', 'in:concert,gala,sport,culturel,conference,autre'],
            'telephone'       => ['required', 'string', 'max:20'],
            'description'     => ['required', 'string', 'min:50'],
        ]);

        $user = auth()->user();

        // Vérifier si une demande existe déjà
        $demande = DemandeOrganisateur::where('user_id', $user->id)
            ->latest()
            ->first();

        if ($demande) {
            // Mettre à jour la demande existante
            // et la remettre en attente si elle avait été refusée
            $demande->update([
                ...$validated,
                'statut'        => 'en_attente',
                'message_refus' => null,
            ]);
        } else {
            // Créer une nouvelle demande
            DemandeOrganisateur::create([
                ...$validated,
                'user_id' => $user->id,
                'statut'  => 'en_attente',
            ]);
        }

        return redirect()
            ->route('demande.organisateur.form')
            ->with('success', 'Votre demande a été envoyée avec succès. L\'administrateur va l\'examiner.');
    }
}