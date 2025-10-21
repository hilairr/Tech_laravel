<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        // Accès réservé aux admins
        $this->middleware(['auth', 'role:admin']);
    }

    /**
     * Affiche toutes les commandes
     */
    public function commandes()
    {
        // On récupère toutes les commandes avec l’utilisateur et le nombre d’articles
        $orders = Order::with('user')
            ->withCount('items') // items_count disponible dans la vue
            ->orderByDesc('created_at')
            ->get();

        // On renvoie la vue 'admin.commande' avec la variable $orders
        return view('admin.commande', compact('orders'));
    }

    /**
     * Supprime une commande
     */
    public function destroy(Order $order)
    {
        if (method_exists($order, 'items')) {
            $order->items()->delete();
        }

        $order->delete();

        return redirect()
            ->route('admin.commandes') // redirection vers la liste des commandes
            ->with('success', 'Commande supprimée avec succès.');
    }
}
