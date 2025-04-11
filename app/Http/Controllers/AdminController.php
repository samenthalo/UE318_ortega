<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminController extends Controller
{
public function dashboard()
{
    $newRegistrations = User::where('status', 'pending')->get(); // Exemple, selon ton modèle de données
    return view('pages_site.dashboard', compact('newRegistrations'));
}
public function approve($id)
{
    // Trouver l'utilisateur par son ID
    $user = User::findOrFail($id);
    
    // Changer le statut de l'utilisateur à 'approved'
    $user->status = 'approved';
    $user->save();

    // Rediriger vers le tableau de bord avec un message de succès
    return redirect()->route('admin.dashboard')->with('success', 'Utilisateur validé avec succès.');
}

public function reject($id)
{
    // Trouver l'utilisateur par son ID
    $user = User::findOrFail($id);
    
    // Changer le statut de l'utilisateur à 'rejected'
    $user->status = 'rejected';
    $user->save();

    // Rediriger vers le tableau de bord avec un message de succès
    return redirect()->route('admin.dashboard')->with('success', 'Utilisateur refusé.');
}


}

