<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Cart\CartController;
use Session;
use Validator;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prod = Product::latest()->paginate(5);
        return view('product.index', compact('prod'))
        ->with('i',(request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cat = Category::pluck('Category','id');
        $brand = Brand::pluck('brand','id');
        return view('product.create', compact('cat','brand'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'prodName' => 'required|regex:/^[\pL\s\-]+$/u',
            'size' => 'required',
            'Category' => 'required',
            'brands' => 'required',
            'quantity' => 'required|numeric',
            'price' => 'required',
        ]);

        $prod = Product::create($request->all());
        Session::flash('flash_message','Product is successfully created!');
        return redirect()->route('product.index');
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prod = Product::find($id);
        return view('product.edit')->with('prod',$prod);
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
        
        $this->validate($request,[
            'prodName' => 'required|regex:/^[\pL\s\-]+$/u',
            'size' => 'required',
            'Category' => 'required',
            'brands' => 'required',
            'quantity' => 'required|numeric',
            'price' => 'required',
        ]);

        $prod = Product::find($id);
        $newInput = $request->all();
        $prod->update($newInput);

        Session::flash('flash_message','Product successfully updated!');
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prod = Product::find($id);
        $prod->delete();

        Session::flash('flash_message','Product successfully deleted!');
        return redirect()->route('product.index');
    }
}
