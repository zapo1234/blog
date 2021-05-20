<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\VerificationController;
use App\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    //

    public  function list(){

        $listes = Products::All();
        return view('product/article', compact('listes'));
    }

    public function Show(Products $product){

        return view('product/product',  compact('product'));
    }

}
