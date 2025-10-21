<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Panier;
use App\Models\Commande;
use App\Models\Boutique;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Paiement;


class PanierController extends Controller
{
    // Ajouter un produit au panier
    public function store(Request $request, $id)
    {
        $boutique = Boutique::findOrFail($id);
        $sessionId = session()->getId();

        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $quantity = $request->input('quantity', 1);

        $panierItem = Panier::where('session_id', $sessionId)
            ->where('boutique_id', $id)
            ->first();

        if ($panierItem) {
            $panierItem->update(['quantity' => $panierItem->quantity + $quantity]);
        } else {
            Panier::create([
                'session_id' => $sessionId,
                'boutique_id' => $id,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->route('paniers.cart')->with('success', 'Produit ajouté au panier !');
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

    // Mettre à jour les quantités
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

    // Validation du paiement
    public function validation(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|digits:8',
            'otp' => 'required|digits:4',
        ]);

        $sessionId = session()->getId();
        $cartItems = Panier::with('boutique')->where('session_id', $sessionId)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('paniers.cart')->with('error', 'Votre panier est vide.');
        }

        // Vérification OTP (exemple simple, remplacer par vrai système)
        if ($request->otp !== '1234') {
            return back()->withErrors(['otp' => 'Code OTP invalide.']);
        }

        $total = $cartItems->sum(function ($item) {
            return ($item->boutique->prixpromo > 0 ? $item->boutique->prixpromo : $item->boutique->prix) * $item->quantity;
        });
        // Sauvegarder le paiement dans la base
        $paiement = Paiement::create([
            'user_id' => Auth::id(),
            'phone_number' => $request->phone_number,
            'otp' => $request->otp,
            'montant' => $total,
            'status' => 'payé',
        ]);


        // Créer la commande
        $commande = Commande::create([
            'user_id' => Auth::id(),
            'phone_number' => $request->phone_number,
            'total' => $total,
            'status' => 'payée',
        ]);

        // Vider le panier
        Panier::where('session_id', $sessionId)->delete();

        // Redirection vers la page de confirmation avec l’ID de la commande
        return redirect()->route('paniers.confirmation', $commande->id)
            ->with('success', 'Commande validée avec succès !');
    }



    // Page de confirmation
    public function confirmation($id)
    {
        $commande = Commande::findOrFail($id);
        return view('paniers.confirmation', compact('commande'));
    }

    // Télécharger le reçu PDF
    public function telechargerRecu($id)
    {
        $commande = Commande::findOrFail($id);
        $pdf = Pdf::loadView('paniers.recu', compact('commande'));
        return $pdf->download('recu_commande_' . $commande->id . '.pdf');
    }

    // Supprimer un produit
    public function removeFromCart($id)
    {
        $panierItem = Panier::findOrFail($id);
        if ($panierItem->session_id === session()->getId()) {
            $panierItem->delete();
        }

        return redirect()->route('paniers.cart')->with('success', 'Produit retiré du panier !');
    }

    // Vue admin
    public function admin()
    {
        $paniers = Panier::all();
        return view('admin.commande', compact('paniers'));
    } // Page du paiement avant validation
    public function validationPage()
    {
        $sessionId = session()->getId();
        $cartItems = Panier::with('boutique')->where('session_id', $sessionId)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('paniers.cart')->with('error', 'Votre panier est vide.');
        }

        $total = $cartItems->sum(function ($item) {
            return ($item->boutique->prixpromo > 0 ? $item->boutique->prixpromo : $item->boutique->prix) * $item->quantity;
        });

        return view('paniers.validation', compact('cartItems', 'total'));
    }
}
