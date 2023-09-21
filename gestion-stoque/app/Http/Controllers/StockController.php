<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockRequest;
use App\Models\commande;
use App\Models\Commandedetail;
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
        $commandes = Commande::all();
        $products = Product::select('name')->get();
        $dates = commande::select('order_date')->distinct()->get();
        return Inertia::render('Commandes', compact('products', 'commandes', 'dates'));
    }

    public function commandeShow($id)
    {
        $commande = Commande::find($id);
        $details = Commandedetail::where('commande_id', $commande->id)->get();
        return Inertia::render('Details', compact('commande', 'details'));
    }

    public function commandesSorted(Request $request)
    {
        $commandes = Commande::where('order_date', $request->date)->get();
        $products = Product::select('name')->get();
        $dates = commande::select('order_date')->get();
        return Inertia::render('Commandes', compact('products', 'commandes', 'dates'));
    }

    public function commandeStore(Request $request)
    {
        $request->validate([
            'client' => 'required|min:7',
            'date' => 'required|date',
            'articles'=>'array|required',
            'articles.*.name'=>'required',
            'articles.*.quantite'=>'required|numeric'
        ]);
        $total = 0;

        foreach ($request->articles as $article) {
            $infos = Product::select('price', 'quantity')->where('name', $article['name'])->first();
            if ($infos['quantity'] >= $article['quantite']) {
                $total += $infos['price'] * $article['quantite'];
            } else {
                $commandes = Commande::where('order_date', $request->date)->get();
                $products = Product::select('name')->get();
                $dates = commande::select('order_date')->get();
                $error = "La quantité de " . $article['name'] . " en stock n'atteint pas la demande";
                return Inertia::render('Commandes', compact('products', 'error', 'commandes', 'dates'));
            }
        }

        Commande::create([
            'customer_name' => $request->client,
            'order_date' => $request->date,
            'total_amount' => $total,
        ]);

        $commande = Commande::where('customer_name', $request->client)->Where('order_date', $request->date)->first();

        foreach ($request->articles as $article) {
            $product = Product::where('name', $article['name'])->first();
            $product->quantity -= $article['quantite'];
            $product->save();

            Commandedetail::create([
                'product' => $product->name,
                'commande_id' => $commande->id,
                'quantity' => $article['quantite'],
                'unit_price' => $product->price,
            ]);

            Movement::create([
                'product' => $product->name,
                'movement_type' => 'Sortie',
                'quantity' => -$article['quantite'],
            ]);
        }
        return redirect()->route('stock');
    }

    public function store(StockRequest $request)
    {
        $product = Product::Where('name', $request->article)->Where('categorie', $request->categorie)->first();
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

            Movement::create([
                'product' => $request->article,
                'movement_type' => 'Entrée',
                'quantity' => $request->quantite,
            ]);
        }
        return redirect()->route('stock');
    }

    public function update(Request $request)
    {
        foreach ($request->articles as $article) {
            //dd($article['name']);
            $product = Product::Where('name', $article['name'])->first();

            if ($product->quantity >= $article['quantite']) {
                $product->quantity -= $article['quantite'];
                $product->save();
                Movement::create([
                    'product' => $article['name'],
                    'movement_type' => 'Sortie',
                    'quantity' => -$article['quantite'],
                ]);
            } else {
                $products = Product::all();
                $error = "La quantité de " . $article['name'] . " en stock n'atteint pas la demande";
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
