<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProduitController extends Controller
{
    // Afficher tous les produits
    public function produit()
    {
        $produits = Produit::all();
        return view('exo.produit', compact('produits'));
    }

    // Afficher le formulaire de création
    public function formproduit()
    {
        return view('exo.formproduit');
    }

    // Valider et créer un produit
    public function store(Request $request)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'nomproduit' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'quantite' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image facultative
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Gestion de l'upload de l'image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('produits', 'public');
        }

        // Création du produit
        Produit::create([
            'nomproduit' => $request->nomproduit,
            'prix' => $request->prix,
            'quantite' => $request->quantite,
            'description' => $request->description,
            'image' => $imagePath, // Si null, l'accessor du modèle retournera l'image par défaut
        ]);

        return redirect()->route('exo.produit')->with('success', 'Produit créé avec succès.');
    }

    // Afficher le formulaire de modification
    public function edit($id)
    {
        $produit = Produit::findOrFail($id);
        return view('exo.modification', compact('produit'));
    }

    // Mettre à jour un produit
    public function update(Request $request, $id)
    {
        $produit = Produit::findOrFail($id);

        // Validation des données
        $validator = Validator::make($request->all(), [
            'nomproduit' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'quantite' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Gestion de l'upload de la nouvelle image
        $imagePath = $produit->image;
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe et n'est pas l'image par défaut
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('produits', 'public');
        }

        // Mise à jour du produit
        $produit->update([
            'nomproduit' => $request->nomproduit,
            'prix' => $request->prix,
            'quantite' => $request->quantite,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('exo.produit')->with('success', 'Produit mis à jour avec succès.');
    }

    // Supprimer un produit
    public function destroy($id)
    {
        $produit = Produit::findOrFail($id);

        // Supprimer l'image associée si elle existe et n'est pas l'image par défaut
        if ($produit->image && Storage::disk('public')->exists($produit->image)) {
            Storage::disk('public')->delete($produit->image);
        }

        $produit->delete();

        return redirect()->route('exo.produit')->with('success', 'Produit supprimé avec succès.');
    }
    public function show($id)
    {
        $produit = Produit::findOrFail($id);
        return view('exo.details', compact('produit'));
    }
}