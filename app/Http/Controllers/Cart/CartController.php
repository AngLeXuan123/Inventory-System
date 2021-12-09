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
    public function cart(Request $request)
    {
        if(is_null(Auth::user())){
            return redirect()->route('login');
        }else{
            $carts = Cart::all()->where('user_id','=',Auth::user()->id);
            $userCart = Auth::id();
            return view('product.cart', compact('carts','userCart'));
        }
     
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function addToCart($id)
    {
        if(is_null(Auth::user())){
            return redirect()->route('login');
        }else{
            $prod = Product::find($id);
            if($prod->quantity == 0){
                Session::flash('error','Product is out of stock!');
                return redirect()->route('welcome');
            }else{
                $users_id = Auth::id(); 
                $quantityCount = 1;
                $cartItem = new Cart;
                $cartItem->user_id = $users_id;
                $cartItem->product_id = $prod->id;
                $cartItem->productName = $prod->prodName;
                $cartItem->productSize = $prod->size;
                $cartItem->productBrand = $prod->brands;
                $cartItem->productCategory = $prod->Category;
                $cartItem->productPrice = $prod->price;
                $cartItem->cartQuantity = $quantityCount;
                $cartItem->subTotal = $cartItem->productPrice * $cartItem->cartQuantity;
                $cartItem->save();
        
                $prod->decrement('quantity', $cartItem->cartQuantity);
                
                Session::flash('flash_message','Product is successfully added to cart!');
                return redirect()->route('welcome');
            }
        }
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function update(Request $request, $id)
    {
        
        $cartItem = Cart::find($id);
        $product_id = $cartItem->products;
       
        if($product_id->quantity <= 0 ){
            Session::flash('error',' Out of stock!');
        } else if($request->cartQuantity > $product_id->quantity){
            Session::flash('error',' Product is in low stock!');
        } else if($request->cartQuantity > $cartItem->cartQuantity ){
            $cartItem = Cart::find($id);
            $product_id = $cartItem->products;
            $updatedQty = ($request->cartQuantity) - ($cartItem->cartQuantity);
            $cartItem->cartQuantity = $request->cartQuantity;
            $cartItem->subTotal = $cartItem->productPrice * $cartItem->cartQuantity;
            Session::flash('status','Quantity successfullydd updated!');
            $cartItem->update();
            $product_id->decrement('quantity', $updatedQty);
        }else if($request->cartQuantity < $cartItem->cartQuantity){
            $cartItem = Cart::find($id);
            $product_id = $cartItem->products;
            $updatedQty = ($cartItem->cartQuantity) - ($request->cartQuantity) ;
            $cartItem->cartQuantity = $request->cartQuantity;
            $cartItem->subTotal = $cartItem->productPrice * $cartItem->cartQuantity;
            Session::flash('status','Quantity successfullydd updated!');
            $cartItem->update();
            $product_id->increment('quantity', $updatedQty);
        } else{
            Session::flash('status','Quantity remain unchanged!');
        }
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove($id)
    {
       $cartItem = Cart::find($id);
       $cartQ = $cartItem->products;
       $cartQ->increment('quantity',$cartItem->cartQuantity);
       $cartItem->delete();

       Session::flash('status','Item successfully deleted!');
       return response()->json(['success' => 'Item has been remove']);
    }
}