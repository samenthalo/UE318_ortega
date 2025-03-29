<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membre;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ControleurMembres extends Controller
{
    // Afficher tous les membres
    public function index() {
        $les_membres = Membre::all();
        return view('pages_site/membres', compact('les_membres'));
    }

    // Afficher un membre spécifique
    public function show($id) {
        $membre = Membre::find($id);

        if (!$membre) {
            return redirect()->route('membres.index')->with('error', 'Membre non trouvé.');
        }

        // Récupérer la biographie du membre (si elle existe)
        $biographie = Biographie::where('user_id', $id)->first();

        // Passer la biographie à la vue
        return view('pages_site/membre_detail', compact('membre', 'biographie'));
    }
    
        public function storeBiographie(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|string|max:1000',
        ]);

        $biographie = Biographie::updateOrCreate(
            ['user_id' => $id],
            ['description' => $request->description]
        );

        return redirect()->route('membres.show', $id);
    }
    public function updateBiographie(Request $request, $id)
{
    // Validation de la biographie
    $request->validate([
        'description' => 'required|string|max:1000',
    ]);

    // Récupérer le membre
    $membre = Membre::find($id);

    if (!$membre) {
        return redirect()->route('membres.index')->with('error', 'Membre non trouvé.');
    }

    // Trouver ou créer la biographie
    $biographie = Biographie::updateOrCreate(
        ['user_id' => $id],
        ['description' => $request->description]
    );

    return redirect()->route('membres.show', $id)->with('success', 'Biographie mise à jour avec succès.');
}


    // Formulaire d'ajout d'un membre
    public function create() {
        return view('pages_site/membre_create');
    }

    // Afficher la page de sélection d'un membre à modifier
    public function selectMembre() {
        $membres = Membre::all(); // Récupérer tous les membres
        return view('pages_site/select_membre', compact('membres')); // Page pour sélectionner un membre
    }

    // Enregistrer un nouveau membre
    public function store(Request $request) {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
        ]);

        $membre = new Membre();
        $membre->nom = $request->nom;
        $membre->prenom = $request->prenom;
        $membre->adresse = $request->adresse;
        $membre->user_id = Auth::id(); // Lier au compte connecté
        $membre->save();

        // Redirection avec message de confirmation
        return redirect()->route('confirmation', ['operation' => 'ajout']);
    }

    // Modifier un membre
    public function edit($id)
    {
        // Vérifier si l'utilisateur est bien connecté
        if (!Auth::check()) {
            Log::info("Utilisateur non connecté, erreur 403");
            abort(403, 'Vous devez être connecté pour accéder à cette page.');
        }

        $membre = Membre::find($id);

        // Vérifier si le membre existe
        if (!$membre) {
            Log::info("Membre non trouvé, ID: {$id}");
            return redirect()->route('membres.index')->with('error', 'Membre non trouvé.');
        }

        // Vérifier si l'utilisateur connecté est bien celui qui a créé le membre
        if (Auth::id() !== $membre->user_id) {
            Log::warning("Accès refusé ! Utilisateur " . Auth::id() . " essaye d'accéder au membre " . $membre->id);
            abort(403, 'Vous n\'avez pas l\'autorisation de modifier ce membre.');
        }

        return view('pages_site.membre_edit', compact('membre'));
    }

    // Mettre à jour les données du membre
    public function update(Request $request, $id) {
        $membre = Membre::find($id);
    
        // Vérifier si le membre existe
        if (!$membre) {
            return redirect()->route('membres.index')->with('error', 'Membre non trouvé.');
        }

        // Vérifier si l'utilisateur connecté est celui qui a créé ce membre
        if (Auth::id() !== $membre->user_id) {
            return redirect()->route('membres.index')->with('error', 'Vous n\'avez pas l\'autorisation de modifier ce membre.');
        }

        // Valider les nouvelles données
        $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
        ]);

        // Mettre à jour les données du membre
        $membre->prenom = $request->prenom;
        $membre->nom = $request->nom;
        $membre->adresse = $request->adresse;
        $membre->save();

        // Rediriger vers la page de confirmation
        return redirect()->route('confirmation', ['operation' => 'modification']);
    }

    // Suppression d’un membre
    public function destroy($id) {
        $membre = Membre::find($id);

        if (!$membre || $membre->user_id !== Auth::id()) {
            return redirect()->route('membres.index')->with('error', 'Accès refusé.');
        }

        $membre->delete();

        // Rediriger vers la page de confirmation
        return redirect()->route('confirmation', ['operation' => 'suppression']);
    }
    public function confirmation($operation)
{
    return view('pages_site.confirmation', compact('operation'));
}

}

