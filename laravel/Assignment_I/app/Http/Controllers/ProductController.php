<?php

namespace App\Http\Controllers;

use App\Contracts\Services\Products\ProductServiceInterface;
use App\Http\Requests\UserProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    private $productInterface;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProductServiceInterface $productServiceInterface)
    {
        $this->productInterface = $productServiceInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productInterface->getProducts();

        return view('products.index', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }
    /**
     * Display softdeleted list
     *
     * @return \Illuminate\Http\Response
     */
    public function showTrash()
    {  
        $products = $this->productInterface->getTrashProducts();

        return view('products.trash', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\UserProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserProductRequest $request)
    {
        $validated = $request->validated();
        $this->productInterface->addProduct($request);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UserProductRequest $request, Product $product)
    {
        $validated = $request->validated();
        $this->productInterface->updateProduct($request, $product);

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->productInterface->deleteProduct($product);

        return redirect()->route('products.index');
    }
}
