<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\PaymentTokens;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;
use App\Models\Cart;
use App\Helpers\Helper;
use Session;
use Stripe;
use Carbon\Carbon;
use App\Mail\TestMail;

class PaymentTokensController extends Controller
{
     /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */

    public function payment_form(Request $request)
    {
        
        $code = $request->token;
        $payment_token = PaymentTokens::where('code','=', $code)->first();
        $payment_order = $payment_token->order;
        $orderItems = $payment_order->orderItems;
        $order = $payment_token->order;

        if(Carbon::now() > $payment_token->expiry_date){
            $expMsg = '
            <h1 style="text-align:center; color:grey; font-family:Courier New; margin-top:250px;">419</h1>
            <hr style="width:25%;">
            <p style="text-align:center; color:grey; font-family:Courier New;">This Page is expired</p>
            ';
            return $expMsg;
        }

        return view('pay.payment_Form', compact('code','orderItems','order'));
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request, $order_id)
    {

        $payment_orderId = PaymentTokens::where('order_id','=', $order_id)->first();
        $order = $payment_orderId->order;
        $orderItems = $order->orderItems;

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
            "amount" => 100 * $orderItems->sum('tAmount'),
            "currency" => "myr",
            "source" => $request->stripeToken,
            "description" => "",
        ]);

        Session::flash('success', 'Payment successful!');
           
        return back();
    }
}   