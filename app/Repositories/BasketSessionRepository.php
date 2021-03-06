<?php

namespace App\Repositories;

use App\Products;

class BasketSessionRepository implements BasketInterfaceRepository  {

    # Afficher le panier
    public function show () {
        return view("basket.show"); // resources\views\basket\show.blade.php
    }

    # Ajouter/Mettre à jour un produit du panier
    public function add (Products $product, $quantity) {
        $basket = session()->get("basket"); // On récupère le panier en session

        // Les informations du produit à ajouter
        $product_details = [
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $quantity
        ];

        $basket[$product->id] = $product_details; // On ajoute ou on met à jour le produit au panier
        session()->put("basket", $basket); // On enregistre le panier
    }

    # Retirer un produit du panier
    public function remove (Products $product) {
        $basket = session()->get("basket"); // On récupère le panier en session
        unset($basket[$product->id]); // On supprime le produit du tableau $basket
        session()->put("basket", $basket); // On enregistre le panier
    }

    # Vider le panier
    public function empty () {
        session()->forget("basket"); // On supprime le panier en session
    }

}

