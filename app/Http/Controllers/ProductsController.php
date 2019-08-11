<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products =\App\Product::all();

        return view('products.index', ['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = \App\Category::get();
        return view('products.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name'=>'required',
            'category_id'=>'required',
            'status'=> 'required|boolean',
            'picture'=> 'required',
            'gender' => 'required',
          ]);
          if ($request->hasFile('picture')) {
            $image = $request->file('picture');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $pic = "images/{$name}";
            $products = new \App\Product([
                'name' => $request->get('name'),
                'category_id' => $request->get('category_id'),
                'status'=> $request->get('status'),
                'picture'=> $pic,
                'gender' => $request->gender,
              ]);
              $products->save();
              return redirect('/products')->with('success', 'Stock has been added');
        }else{
            echo 'no img';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = \App\Product::find($id);
        $categories = \App\Category::get();

        return view('products.edit',['product'=>$product, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required',
            'category_id'=>'required|integer',
            'status'=> 'required|boolean',
            'picture'=> 'required',
            'gender' => 'required',
          ]);
          $pic = null;
          if ($request->hasFile('picture')) {

            $image = $request->file('picture');
            $name = uniqid().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $pic = "images/{$name}";
          }
          $product = \App\Product::find($id);
          $product->name = $request->get('name');
          $product->category_id = $request->get('category_id');
          $product->status = $request->get('status');
          $product->picture = $pic;
          $product->gender = $request->get('gender');
          $product->save();

          return redirect('/products')->with('success', 'Stock has been updated');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = \App\Product::find($id);
        $product->delete();

        return redirect('/products')->with('success', 'Stock has been deleted Successfully');

    }
}
