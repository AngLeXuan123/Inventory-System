<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Carbon\Carbon;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:Dashboard-list', ['only' => ['index','show']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     

    public function index()
    {

        // create a custom hex generator
        function randomHex() {
            $chars = 'ABCDEF0123456789';
            $color = '#';
            for ( $i = 0; $i < 6; $i++ ) {
            $color .= $chars[rand(0, strlen($chars) - 1)];
            }
            return $color;
        }
    
        //User Report
        $userData = User::select('id','created_at')->get()->groupBy(function($userData){
           return Carbon::parse($userData->created_at)->format('M');
        });

        $months = [];
        $numberOfUsers = [];
        foreach($userData as $month => $values){
            $months[] = $month;
            $numberOfUsers[] = count($values);
        }


        //Product Stock Report
        $product_stock = DB::table('products')->get('*')->toArray();

        foreach($product_stock as $stock){
            $product_name[] =  $stock->prodName;
            $product_qty[] = $stock->quantity;
            $product_color[] = randomHex();
        }

        //Top sales of the month (product)
        $count_sales = \DB::table('order_item')
                        ->select('product_id', \DB::raw('COUNT(product_id) as total_count'), 'product_id')
                        ->groupBy('product_id')
                        ->get();
        
        foreach($count_sales as $sales){
            $product = Product::find($sales->product_id);
            $sales_name[] = $product->prodName;
            $total_sales[] = $sales->total_count;
            $sales_color[] = randomHex();
        }

        $product_sales = isset($total_sales) ? ($total_sales) : 0;
        $product_sales_name = isset($sales_name) ? ($sales_name) : 0;
        $product_sales_color = isset($sales_color) ? ($sales_color) : 0;


        //Total order report
        $total_order = Order::select('id', 'created_at')->get()->groupBy(function($total_order){
            return Carbon::parse($total_order->created_at)->format('M');
        });

        foreach($total_order as $month => $order){
            $order_month[] = $month;
            $order_report[] = count($order);
            $order_color[] = randomHex();
        }
        
        //current time
        $month = Carbon::now()->format('d F Y');
        $time = Carbon::now()->format('g:i A');

        return view('adminHome', ['userData' => $userData, 'months' => $months, 'numberOfUsers' => $numberOfUsers, "month" => $month, 
        "product_stock" => $product_stock, "product_name" => $product_name, "product_qty" => $product_qty, "time" => $time, "product_color" => $product_color,
        "product_sales" => $product_sales , "product_sales_name" => $product_sales_name, "product_sales_color" => $product_sales_color,
        "order_month" => $order_month, "order_report" => $order_report, "order_color" => $order_color]);
    }
}