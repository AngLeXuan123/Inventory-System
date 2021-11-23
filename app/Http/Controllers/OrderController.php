<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\PaymentTokens;
use App\Http\Controllers\Controller;
use App\Mail\TestMail;
use App\Helpers\Helper;
use Session;
use DB;
use PDF;
use Carbon\Carbon;



class OrderController extends Controller
{

    public $generateToken;
    public function __construct()
    {
        $this->middleware('auth');
        $this->generateToken = new PaymentTokens;
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
            'email' => 'required|email',
            'address' => 'required',
            'phoneNum' => 'required|regex:/[0-9]{10}/',
        ]);
        
        $order = new Order;
        $inv_id = Helper::invoiceIDGenerator(new Order, 'invoice_id', 5, 'INV');
        $order->invoice_id = $inv_id;
        $order->custName = $request->custName;
        $order->email = $request->email;
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

            $tokenCode = new PaymentTokens;
            $tokenCode->order_id = $order->id;
            $generated_Code = $this->generateToken->generateUniqueCode();
            $tokenCode->code = $generated_Code;
            $add_Days = 2;
            $create_expiry_date = Carbon::now()->addDays($add_Days)->format('Y-m-d');
            $tokenCode->expiry_date = $create_expiry_date;
            $tokenCode->save();

            $detail = [
                'title' => 'SB Engineering',
                'id' => $order->id,
                'code' =>  $generated_Code,
            ];

            Mail::to($order->email)->send(new TestMail($detail));

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
            'email' => 'required|email',
            'address' => 'required',
            'phoneNum' => 'required|regex:/[0-9]{10}/',
        ]);

        $order = Order::find($id);
        $order->custName = $request->custName;
        $order->email = $request->email;
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