<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use App\Http\Controllers\Controller;
use Session;
use PDF;



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
        $prod = Product::all();
        return view('order.create')->with('prod',$prod);
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
            'product_id' => 'required',
            'custName' => 'required|alpha',
            'address' => 'required',
            'phoneNum' => 'required|regex:/[0-9]{10}/',
        ]);
        
        $order = new Order;
        $order->custName = $request->custName;
        $order->address = $request->address;
        $order->phoneNum = $request->phoneNum;

        if($order->save())
        {
            $counter = 0;
            foreach($request->product_id as $product_ids){
                $product = Product::find($product_ids);
                $orderItem = new OrderItem;
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $product_ids;
                $orderItem->order_quantity = $request->order_quantity[$counter];
                $orderItem->tAmount = $request->tAmount[$counter];
                $orderItem->data = $product;
                $orderItem->save();

                $product->decrement('quantity',$orderItem->order_quantity);

                $counter++;
        
            }
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
        $orderItems = $order->orderItems;
        return view('order.edit', compact('order','orderItems'));
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
            'product_id' => 'required',
            'custName' => 'required|alpha',
            'address' => 'required',
            'phoneNum' => 'required|regex:/[0-9]{10}/',
        ]);

        $order = Order::find($id);
        $order->custName = $request->custName;
        $order->address = $request->address;
        $order->phoneNum = $request->phoneNum;
        $order->update();
        
        $orderItems = $order->orderItems;

        $counter = 0;
        foreach($orderItems as $orderItem){
            $item = $orderItem;
            $item->order_quantity = $request->order_quantity[$counter];
            $item->tAmount = $request->tAmount[$counter];
            $item->update();
            $counter++;
        }
        
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
        $orderItems = $order->orderItems;
        
        foreach($orderItems as $orderItem){
            $product = Product::find($orderItem->product_id);
            $product->increment('quantity',$orderItem->order_quantity);
        }
        
        $order->delete();
        Session::flash('flash_message','Order successfully deleted!');
        return redirect()->route('order.index');
    }

    public function invoice($order_id){
        $order = Order::find($order_id);
        $orderItems = $order->orderItems;
        $gTotal = 0;
        //return view('order.invoice', compact('order','orderItems','gTotal'));
        $data = [
            'order' => $order,
            'orderItems' => $orderItems,
            'gTotal' => $gTotal,
        ];
        $pdf = PDF::loadView('order.invoice',$data);
        return $pdf->download('SB Engineering.pdf');
       
    }


}