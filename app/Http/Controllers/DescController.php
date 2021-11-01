<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Desc;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Session;

class DescController extends Controller
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
        $descs = Desc::latest()->paginate(10);
        return view('desc.index',compact('descs'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('desc.create');
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
            'title' => 'required',
            'desc' => 'required',
        ]);
        
        //store created task into database
        
        $descs = new Desc();
        $descs -> title = $request -> title;
        $descs -> desc = $request -> desc;

        if(Auth::user() -> desc() -> save($descs)){
            Session::flash('flash_message','Description is successfully created!');
            return redirect()->route('desc.index');
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
        $descs = Desc::find($id);
        return view('desc.show')->with('descs',$descs);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $descs = Desc::find($id);
        return view('desc.edit')->with('descs',$descs);
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
        $descs = Desc::find($id);
        $this->validate($request,[
            'title' => 'required',
            'desc' => 'required',
        ]);
        
        $newInput=$request->all();

        $descs->fill($newInput)->save();
    
        Session::flash('flash_message','Description successfully updated!');
        return redirect()->route('desc.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $descs = Desc::find($id);
        $descs->delete();
    
        Session::flash('flash_message', 'Description successfully deleted!');
    
        return redirect()->route('desc.index');
    }
}