<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // Afficher toutes les notifications de l'utilisateur
    public function index()
    {
        $notifications = Notification::where('user_id', auth()->id())
            ->latest()
            ->get();

        // Marquer toutes comme lues quand on ouvre la page
        Notification::where('user_id', auth()->id())
            ->where('lu', false)
            ->update(['lu' => true]);

        return view('notifications', compact('notifications'));
    }

    // Marquer une notification comme lue
    public function marquerLu(Notification $notification)
    {
        // Vérifier que la notification appartient bien
        // à l'utilisateur connecté
        if ($notification->user_id !== auth()->id()) {
            abort(403);
        }

        $notification->update(['lu' => true]);

        return back();
    }

    // Marquer toutes les notifications comme lues
    public function toutLire()
    {
        Notification::where('user_id', auth()->id())
            ->where('lu', false)
            ->update(['lu' => true]);

        return back()->with('success', 'Toutes les notifications ont été lues.');
    }
}