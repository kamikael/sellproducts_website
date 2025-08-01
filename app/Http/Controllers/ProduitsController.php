<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Stand;
use Illuminate\Http\Request;

class ProduitsController extends Controller
{


    public function __construct()
{
    $this->middleware('auth');
}

    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $this->authorize('viewAny', Produit::class);
    $products = Produit::with('stand')->whereHas('stand', function($q){
        $q->where('user_id', auth()->id());
    })->get();
    return view('produits.index', compact('products'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $this->authorize('create', Produit::class);
    $stands = Stand::where('user_id', auth()->id())->get();
    return view('produits.create', compact('stands'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $this->authorize('create', Produit::class);
    $data = $request->validate([
        'nom'=>'required|string|max:255',
        'description'=>'nullable|string',
        'prix'=>'required|numeric',
        'image_url'=>'nullable|url',
        'stand_id'=>'required|exists:stands,id',
        'image_file' => 'nullable|image|max:2048',
    ]);

    // Vérification exclusive : un seul champ image possible
    if ($request->filled('image_url') && $request->hasFile('image_file')) {
        return back()->withInput()->withErrors(['image_url' => 'Veuillez choisir soit une URL, soit un fichier image, pas les deux.']);
    }

    // Gestion de l'upload d'image
    if ($request->hasFile('image_file')) {
        $path = $request->file('image_file')->store('produits', 'public');
        $data['image_url'] = 'storage/' . $path;
    }

    Produit::create($data);
    return redirect()->route('produits.index')->with('success','Produit créé.');
}

/**
 * edit the resourses
 */
    public function edit(Produit $produit)
{
    $this->authorize('update', $produit);
    $stands = Stand::where('user_id', auth()->id())->get();
    return view('produits.edit', compact('produit', 'stands'));
}


/**
 * update
 */
    public function update(Request $request, Produit $produit)
{
    $this->authorize('update', $produit);
    $data = $request->validate([
        'nom'=>'required|string|max:255',
        'description'=>'nullable|string',
        'prix'=>'required|numeric',
        'image_url'=>'nullable|url',
        'stand_id'=>'required|exists:stands,id',
        'image_file' => 'nullable|image|max:2048',
    ]);

    // Vérification exclusive : un seul champ image possible
    if ($request->filled('image_url') && $request->hasFile('image_file')) {
        return back()->withInput()->withErrors(['image_url' => 'Veuillez choisir soit une URL, soit un fichier image, pas les deux.']);
    }

    // Gestion de l'upload d'image
    if ($request->hasFile('image_file')) {
        $path = $request->file('image_file')->store('produits', 'public');
        $data['image_url'] = 'storage/' . $path;
    }

    $produit->update($data);
    return redirect()->route('produits.index')->with('success','Produit mis à jour.');
}

     /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produit $produit)
{
    $this->authorize('delete', $produit);
    $produit->delete();
    return redirect()->route('produits.index')->with('success','Produit supprimé.');
}


}
