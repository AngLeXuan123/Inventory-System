<?php
  
namespace App\Http\Controllers\Cart;
  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Session;
use DB;

class CartController extends Controller
{
 
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function cart()
    {
        $user = Auth::id();
        $cartItem = DB::table('cart')->select('cartData')->where('user_id', '=', $user)->first();
        $o = json_decode($cartItem->cartData,true);
        $b = array($o);
 
        return view('product.cart', compact( 'cartItem','user', 'o', 'b'));

    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function addToCart($id)
    {
        $prod = Product::findOrFail($id);
        $quantityCount = 1;
        $cartArray[$id] = [
            "prodName" => $prod->prodName,
            "size" => $prod->size,
            "brands" => $prod->brands,
            "Category" => $prod->Category,
            "quantity" => $quantityCount,
            "price" => $prod->price,
            "subTotal" => $prod->price * $quantityCount,
        ];
           
        $json = json_encode($cartArray[$id]);
  
        $addCartArray = new Cart;
        $users_id = Auth::id(); 
        $products_id = Product::find($id);
        $addCartArray->user_id = $users_id;
        $addCartArray->product_id = $products_id->id;
        $addCartArray->cartData = $json;
        $addCartArray->save();

        Session::flash('flash_message','Product is successfully added to cart!');
        return redirect()->route('product.cart');
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function update(Request $request)
    {
        return $request->quantity;
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove(Request $request)
    {
       
    }
}