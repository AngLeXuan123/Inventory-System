<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use Session;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Brand-list|Brand-create|Brand-edit|Brand-delete', ['only' => ['index','show']]);
        $this->middleware('permission:Brand-create', ['only' => ['create','store']]);
        $this->middleware('permission:Brand-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Brand-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand = Brand::all();
        return view('brand.index', compact('brand'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'brand' => 'required|alpha|unique:brands',
        ]);

        $brand = $request->all();
        Brand::create($brand);
        Session::flash('flash_message','Brand is successfully created!');
        return redirect()->route('brand.index');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('brand.edit')->with('brand',$brand);
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
        $brand = Brand::find($id);
        $this->validate($request,[
            'brand' => 'required|alpha',
        ]);

        $newInput = $request->all();
        $brand->fill($newInput)->save();

        Session::flash('flash_message','Brand successfully updated!');
        return redirect()->route('brand.index');
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);
        $brand->delete();

        Session::flash('flash_message','Brand successfully deleted!');
        return redirect()->route('brand.index');
    }
}
