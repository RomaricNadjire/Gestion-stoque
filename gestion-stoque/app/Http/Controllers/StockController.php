<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockRequest;
use App\Models\Movement;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StockController extends Controller
{
    public function stock()
    {
        $products = Product::all();
        $categories = Product::select('categorie')->distinct()->get();
        return Inertia::render('Stock', compact('products', 'categories'));
    }

    public function sorted(Request $request)
    {
        $products = Product::Where('categorie', $request->categorie)->orderBy('id', 'asc')->get();
        $categories = Product::select('categorie')->distinct()->get();
        return Inertia::render('Stock', compact('products', 'categories'));
    }

    public function registration()
    {
        return Inertia::render('ProductAdd');
    }

    public function out()
    {
        $products = Product::all();
        return Inertia::render('Out', compact('products'));
    }

    public function commandes()
    {
        return Inertia::render('Commandes');
    }

    public function store(StockRequest $request)
    {
        $product = Product::Where('name', $request->article)->first();
        if ($product) {
            $product->description = $request->description;
            $product->price = $request->prix;
            $product->quantity += $request->quantite;
            $product->save();

            Movement::create([
                'product' => $product->name,
                'movement_type' => 'Entrée',
                'quantity' => $request->quantite,
            ]);
        } else {
            Product::create([
                'name' => $request->article,
                'description' => $request->description,
                'price' => $request->prix,
                'quantity' => $request->quantite,
                'categorie' => $request->categorie,
            ]);
        }
        return redirect()->route('stock');
    }

    public function update(Request $request)
    {
        foreach ($request->articles as $article) {
            //dd($article['name']);
            $product = Product::Where('name',$article['name'])->first();

            if ($product->quantity >= $article['quantite']){
                $product->quantity -= $article['quantite'];
                $product->save();
                Movement::create([
                    'product' =>$article['name'],
                    'movement_type' => 'Sortie',
                    'quantity' => -$article['quantite'],
                ]);
            } else {
                $products = Product::all();
                $error = "La quantité de ".$article['name']." en stock n'atteint pas la demande";
                return Inertia::render('Out', compact('products', 'error'));
            }}
            return redirect()->route('stock');
    }

    public function history()
    {
        $movements = Movement::all();
        $products = Product::select('name')->distinct()->get();
        return Inertia::render('History', compact('movements', 'products'));
    }

    public function sort(Request $request)
    {
        $movements = Movement::Where('product', $request->product)->orderBy('id', 'asc')->get();
        $products = Product::select('name')->distinct()->get();
        return Inertia::render('History', compact('movements', 'products'));
    }
}
