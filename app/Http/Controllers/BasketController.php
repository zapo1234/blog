<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\BasketInterfaceRepository;

use App\Products;

class BasketController extends Controller
{

    protected $basketRepository; // L'instance BasketSessionRepository

    public function __construct (BasketInterfaceRepository $basketRepository) {
        $this->basketRepository = $basketRepository;
    }

    # Affichage du panier
    public function show () {
        return view("basket.show"); // resources\views\basket\show.blade.php
    }

    # Ajout d'un produit au panier
    public function add (Products $product, Request $request) {

        // Validation de la requête
        $this->validate($request, [
            "quantity" => "numeric|min:1"
        ]);

        // Ajout/Mise à jour du produit au panier avec sa quantité
        $this->basketRepository->add($product, $request->quantity);

        // Redirection vers le panier avec un message
        return redirect()->route("basket.show")->withMessage("Produit ajouté au panier");
    }

    // Suppression d'un produit du panier
    public function remove (Products $product) {

        // Suppression du produit du panier par son identifiant
        $this->basketRepository->remove($product);

        // Redirection vers le panier
        return back()->withMessage("Produit retiré du panier");
    }

    public function article (Products $product){

        return view('basket/product',  compact('product'));
    }

    // Vider la panier
    public function empty () {

        // Suppression des informations du panier en session
        $this->basketRepository->empty();

        // Redirection vers le panier
        return back()->withMessage("Panier vidé");

    }

}
