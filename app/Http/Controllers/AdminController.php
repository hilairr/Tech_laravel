<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    // Liste des rôles autorisés
    private const VALID_ROLES = ['admin', 'contrôleur', 'utilisateur'];

    /**
     * AdminController constructor.
     * Applique le middleware pour restreindre l'accès aux administrateurs uniquement.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    /**
     * Affiche la liste de tous les utilisateurs.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::all();
        return view('acceuille.index', compact('users'));
    }

    /**
     * Met à jour le rôle d'un utilisateur.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function updateRole(Request $request, User $user)
    {
        // Validation des données
        $request->validate([
            'role' => ['required', 'in:' . implode(',', self::VALID_ROLES)],
        ], [
            'role.required' => 'Le rôle est obligatoire.',
            'role.in' => 'Le rôle sélectionné n\'est pas valide.'
        ]);

        try {
            // Mise à jour du rôle dans une transaction
            DB::transaction(function () use ($request, $user) {
                $user->update(['role' => $request->role]);
            });

            // Réponse pour une requête web
            return redirect()->route('admin.users')->with('success', 'Rôle mis à jour avec succès.');
        } catch (\Exception $e) {
            // Journalisation de l'erreur
            Log::error('Erreur lors de la mise à jour du rôle de l\'utilisateur : ' . $e->getMessage());

            // Réponse pour une requête web
            return redirect()->route('admin.users')->with('error', 'Une erreur est survenue lors de la mise à jour du rôle.');
        }
    }
}