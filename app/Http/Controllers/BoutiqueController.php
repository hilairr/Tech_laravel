<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Boutique;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class BoutiqueController extends Controller
{
    // Afficher tous les produits
    public function acceuille()
    {
        
        return view('acceuille.index');
    }
     public function index()
    {
        $boutiques = Boutique::all();
        return view('boutiques.boutique', compact('boutiques'));
    }

     public function admin()
    {
        $boutiques = Boutique::all();
        return view('admin.index', compact('boutiques'));
    }
    
    // Afficher le formulaire de création
    public function formboutique()
    {
        return view('boutiques.formboutique');
    }

    // Valider et créer un produit
    public function store(Request $request)
    {
        $validatedData = $request->validate( [
            'nomproduit' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'prixpromo' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10048',
        ]);

       $validatedData['image'] = null; 

    // Gérer le téléchargement d'image
    if ($request->hasFile('image')) {
        $imagePath = time() . '.' . $request->image->extension();
        $request->image->move(public_path('image'), $imagePath);
        $validatedData['image'] = $imagePath; // Mettez à jour la valeur ici
}

        Boutique::create([
            'nomproduit' => $request->nomproduit,
            'prix' => $request->prix,
            'prixpromo' => $request->prixpromo,
            'description' => $request->description,
            'image' =>  $validatedData['image'],
        ]);

        return redirect()->route('admin.index')->with('success', 'Produit créé avec succès.');
    }

    // Afficher le formulaire de modification
    public function edit($id)
    {
        $boutique = Boutique::findOrFail($id);
        return view('boutiques.modification', compact('boutique'));
    }

    // Mettre à jour un produit
    public function update(Request $request, $id)
    {
        $boutique = Boutique::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nomproduit' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'prixpromo' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $imagePath = $boutique->image;
        if ($request->hasFile('image')) {
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('boutique', 'public');
        }

        $boutique->update([
            'nomproduit' => $request->nomproduit,
            'prix' => $request->prix,
            'prixpromo' => $request->prixpromo,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.index')->with('success', 'Produit mis à jour avec succès.');
    }

    // Supprimer un produit
    public function destroy($id)
    {
        $boutique = Boutique::findOrFail($id);

        if ($boutique->image && Storage::disk('public')->exists($boutique->image)) {
            Storage::disk('public')->delete($boutique->image);
        }

        $boutique->delete();

        return redirect()->route('admin.index')->with('success', 'Produit supprimé avec succès.');
    }
    public function search(Request $request) {
    $query = $request->input('query');
    $boutiques = Boutique::where('nomproduit', 'LIKE', "%{$query}%")
                       ->orWhere('prix', 'LIKE', "%{$query}%")
                       ->get();
    return view('boutiques.boutique', compact('boutique'));
}
}
