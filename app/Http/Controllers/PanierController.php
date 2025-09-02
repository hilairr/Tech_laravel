<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Panier;
use App\Models\Boutique;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage; // Vérifiez que cette ligne est présente
use Illuminate\Support\Facades\Cache;

class PanierController extends Controller
{
    // Ajouter un produit au panier
    public function store(Request $request, $id)
    {
        $boutique = Boutique::findOrFail($id);
        $sessionId = session()->getId();

        // Valider la quantité
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $quantity = $request->input('quantity', 1);

        // Vérifier si le produit est déjà dans le panier
        $panierItem = Panier::where('session_id', $sessionId)
                            ->where('boutique_id', $id)
                            ->first();

        if ($panierItem) {
            // Si le produit existe, incrémenter la quantité
            $panierItem->update(['quantity' => $panierItem->quantity + $quantity]);
        } else {
            // Sinon, créer un nouvel article dans le panier
            Panier::create([
                'session_id' => $sessionId,
                'boutique_id' => $id,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->route('paniers.cart')->with('success', 'Produit ajouté au panier !');
    }


     public function admin()
    {
        $paniers = Panier::all();
        return view('admin.commande', compact('paniers'));
    }

 // pour le payement
     public function valider()
    {
        $sessionId = session()->getId();
        $cartItems = Panier::with('boutique')->where('session_id', $sessionId)->get();
        $total = $cartItems->sum(function ($item) {
            return ($item->boutique->prixpromo > 0 ? $item->boutique->prixpromo : $item->boutique->prix) * $item->quantity;
        });

        return view('paniers.validation', compact('cartItems', 'total'));
    }

    // Afficher le panier
    public function cart()
    {
        $sessionId = session()->getId();
        $cartItems = Panier::with('boutique')->where('session_id', $sessionId)->get();
        $total = $cartItems->sum(function ($item) {
            return ($item->boutique->prixpromo > 0 ? $item->boutique->prixpromo : $item->boutique->prix) * $item->quantity;
        });

        return view('paniers.cart', compact('cartItems', 'total'));
    }

    // Mettre à jour la quantité dans le panier
    public function updateCart(Request $request)
    {
        $quantities = $request->input('quantity', []);

        foreach ($quantities as $id => $quantity) {
            $panierItem = Panier::find($id);
            if ($panierItem && $panierItem->session_id === session()->getId()) {
                if ($quantity < 1) {
                    $panierItem->delete();
                } else {
                    $panierItem->update(['quantity' => $quantity]);
                }
            }
        }

        return redirect()->route('paniers.cart')->with('success', 'Panier mis à jour !');
    }

    // Supprimer un produit du panier
    public function removeFromCart($id)
    {
        $panierItem = Panier::findOrFail($id);
        if ($panierItem->session_id === session()->getId()) {
            $panierItem->delete();
        }

        return redirect()->route('paniers.cart')->with('success', 'Produit retiré du panier !');
    }
}