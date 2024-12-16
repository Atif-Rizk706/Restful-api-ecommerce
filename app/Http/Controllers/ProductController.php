<?php

namespace App\Http\Controllers;

use App\Exceptions\ProductNotBelongeToUser;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResouece;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth:api')->except('show','index');
    }
    public function index()
    {
       return ProductCollection::collection (Product::paginate(20));
        //return Product::all();
       //eturn  ProductResouece::collection(Product::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $product=new Product();
        $product->price=$request->price;
        $product->stock=$request->stock;
        $product->detail=$request->discription;
        $product->name=$request->name;
        $product->discount=$request->discount;
        $product->save();
        return response(['data'=>new ProductResouece($product)],Response::HTTP_CREATED);




    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
         return new ProductResouece($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->productUserCkeck($product);
        $request['detail']=$request->discription;
          unset($request['description']);
          $product->update($request->all());
        return response(['data'=>new ProductResouece($product)],Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->productUserCkeck($product);
        $product->delete();
        return response(null,Response::HTTP_NO_CONTENT);

    }
    public function productUserCkeck($product){
        if(Auth::id() !== $product->user_id){
            throw new ProductNotBelongeToUser;
        }
    }
}
