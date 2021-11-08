<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Session;

class OrderController extends Controller
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
        $order = Order::latest()->paginate(5);
        return view('order.index', compact('order'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prod = Product::pluck('data','id');
        $prods = json_decode($prod, true);
        //$total = $prods['quantity'] * $prods['price'];
        return view('order.create', compact('prods'));
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
            'custName' => 'required|alpha',
            'address' => 'required',
            'phoneNum' => 'required|regex:/[0-9]{10}/',
            'prodName' => 'required',
            'tAmount' => 'required',
            'quantity' => 'required|numeric',
        ]);

        $order = new Order();
        $order -> custName = $request -> custName;
        $order -> address = $request -> address;
        $order -> $phoneNum = $request -> phoneNum;
        $order -> $prodName = $request -> prodName;
        $order -> $tAmount = $request -> tAmount;
        $order -> $quantity = $request -> quantity;
        $order -> $data = $request -> data;

        if(Auth::user()->product()->save($order)){
            Session::flash('flash_message','Order is successfully created!');
            return redirect()->route('order.index');
        }

       
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);
        return view('order.edit')->with('order', $order);
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
        $order = Order::find($id);
        $this->validate($request,[
            'custName' => 'required|alpha',
            'address' => 'required',
            'phoneNum' => 'required|regex:/[0-9]{10}/',
            'prodName' => 'required',
            'tAmount' => 'requried',
            'quantity' => 'required|numeric',
        ]);

        $newInput = $request->all();
        $order->fill($newInput)->save();

        Session::flash('flash_message','Order successfully updated!');
        return redirect()->route('order.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();

        Session::flash('flash_message','Order successfully deleted!');
        return redirect()->route('order.index');
    }
}
