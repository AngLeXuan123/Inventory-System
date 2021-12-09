<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Session;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Category-list|Category-create|Category-edit|Category-delete', ['only' => ['index','show']]);
        $this->middleware('permission:Category-create', ['only' => ['create','store']]);
        $this->middleware('permission:Category-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Category-delete', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cat = Category::all();
        return view('category.index', compact('cat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
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
            'Category' => 'required|alpha|unique:categories',
        ]);

        $cat = $request->all(); 
        Category::create($cat);
        Session::flash('flash_message','Category is successfully created!');
        return redirect()->route('category.index');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat = Category::find($id);
        return view('category.edit')->with('cat',$cat);
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
        $cat = Category::find($id);
        $this->validate($request, [
            'Category' => 'required|alpha|unique:categories',
        ]);

        $newInput = $request->all();
        $cat->fill($newInput)->save();

        Session::flash('flash_message','Category successfully updated!');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = Category::find($id);
        $cat->delete();

        Session::flash('flash_message', 'Category successfully deleted!');
        return redirect()->route('category.index');
    }
}