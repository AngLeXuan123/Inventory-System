<?php

namespace App\Http\Controllers\Cart;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;
use App\Helpers\Helper;
use Session;
use Stripe;
use App\Mail\TestMail;

class CartpaymentController extends Controller
{
    
    //order cart -> customer site
    public function create_Order(Request $request, $user_id){

        $selected_item = $request->selected_item;
        session(["itemSelected" => $request->input('selected_item')]);

        if(is_null($selected_item)){
            Session::flash('error',' Select an item!');
            return redirect()->route('product.cart');
        }else{
            $this->validate($request,[
                'paymentName' => 'required|regex:/^[\pL\s\-]+$/u',
                'paymentEmail' => 'required|email',
                'paymentAddress' => 'required',
                'paymentPhoneNumber' => 'required|regex:/[0-9]{10}/'
            ]);
       
            $order = new Order;
            $inv_id = Helper::invoiceIDGenerator(new Order, 'invoice_id', 5, 'INV');
            $order->invoice_id = $inv_id;
            $order->custName = $request->paymentName;
            $order->email = $request->paymentEmail;
            $order->address = $request->paymentAddress;
            $order->phoneNum = $request->paymentPhoneNumber;
            $order->user_id = $user_id;
    
            if($order->save())
            {
                $cartItem = Cart::where('user_id', '=', $user_id)->whereIn('id',$selected_item)->get();
                
                foreach($cartItem as $item){
                    $product = Product::find($item);
                    $orderItem = new OrderItem;
                    $orderItem->order_id = $order->id;
                    $orderItem->product_id = $item->product_id;
                    $orderItem->order_Quantity = $item->cartQuantity;
                    $orderItem->tAmount = $item->subTotal;
                    $orderItem->data = $product;
                    $orderItem->save();
                }
            }
            return redirect()->route('cust.payment.form',['user_id'=>$user_id, 'order_id' => $orderItem->order_id]);
        }
    }

    //Customer site payment
    public function cust_payment_form(Request $request){
        $orderCart = $request->order_id;
      
        $userCart = $request->user_id;
        
        $cartItem = OrderItem::where('order_id',$orderCart)->get();

        return view('pay.custPayForm', compact('userCart','cartItem','orderCart'));
    }

    public function cust_stripe_post(Request $request, $user_id){

        $orderCart = $request->order_id;
        $userName = User::find($user_id);
        $cartItem = OrderItem::where('order_id',$orderCart)->get();

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create ([
            "amount" => 100 * $cartItem->sum('tAmount'),
            "currency" => "myr",
            "source" => $request->stripeToken,
            "description" => $userName->name,
        ]);

        $clearCart = session("itemSelected");
        $cartItem = Cart::whereIn('id',$clearCart)->delete();
    
        Session::flash('status', 'Payment successful!');
        return redirect()->route('product.cart');
    }
}