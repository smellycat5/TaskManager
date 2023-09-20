<?php

namespace App\Http\Controllers;

use App\Http\Requests\{ProductStoreRequest,ProductEditRequest};
use Illuminate\Http\Request;
use App\Models\Product;
use Spatie\Activitylog\Models\Activity;

class ProductController extends Controller
{
    protected Product $product;

    public function __construct(Product $product) {
        $this->product = $product;
             $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
             $this->middleware('permission:product-create', ['only' => ['create','store']]);
             $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
             $this->middleware('permission:product-delete', ['only' => ['destroy']]);
        
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {  
        $products = $this->product->latest()->paginate(5);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        $data = $request->validated();
        $product = $this->product->create($data);
        $user_id = auth()->user()->id;
        $product->users()->sync($user_id);
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return "showed";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductEditRequest $request, Product $product)
    {
        $data = $request->validated();
        $product->update($data);
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }

    public function activity()
    {
        $activities = Activity::all();
        // dd($activities);
        return view('products.activity', compact('activities'));
    }
}
