<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Stripe;

class HomeController extends Controller
{
     public function index() {
         $products = Product::all();
      
        return view('home.index',compact('products'));
     }
     public function allProduct(){
        $products=Product::all();
        return view('home.product.all-products')->with('products',$products);
    }
    
    public function showCarts(){
        if(Auth::id()){
            $id = Auth::user()->id;
            $cartProducts=Cart::where('user_id',$id)->get();
            return view('home.cart.show-carts')->with('cartProducts',$cartProducts);
        }
            return redirect()->route('login');   
    }
    public function productDetail($id){
     $product = Product::find($id);
     return view('home.product.single-product',compact('product'));
    }
    
    public function addToCart(Request $request,$id){
     
        if(Auth::id()){
           $user = Auth::user();
           $product=Product::find($id);
           $cart= new Cart();
           $cart->name=$user->name;
           $cart->email=$user->email;
           $cart->phone_number=$user->phone;
           $cart->address=$user->address;
           $cart->product_title=$product->title;
           if ($product->discount_price){
            $cart->price=$product->discount_price * $request->quantity;
           }else{
            $cart->price=$product->price * $request->quantity;
           }         
           $cart->image=$product->image;
           $cart->quantity=$request->quantity;
           $cart->user_id= $user->id;
           $cart->product_id=$product->id;
           $cart->save();
           return redirect()->back();

        }else  {
            return redirect('login');
        }
       
       }
      
       public function  deleteCarts($id){
        $cart=Cart::find($id);
        $cart->delete();      
       return redirect()->back();        
    }
    public function cashOrder(){
        $userId=Auth::user()->id;
        $cartInfo= Cart::where('user_id',$userId)->get();
        foreach ($cartInfo as $data ){
            $order = new Order();
            $order->name=$data->name;
            $order->email=$data->email;
            $order->phone_number=$data->phone_number;
            $order->address=$data->address;
            $order->product_title=$data->product_title;       
            $order->price=$data->price;                        
            $order->image=$data->image;
            $order->quantity=$data->quantity;
            $order->user_id= $data->user_id;
            $order->product_id=$data->product_id;
            $order->payment_status='cash on delivery';  
            $order->delivery_status='processing';            
            $order->save();
            $cart_id=$data->id;
            $cart=Cart::find($cart_id);
            $cart->delete();

        }
        return to_route('show-carts' )->with('message','we have recieved your order ');
    }

    public function stripe($totalPrice){
        return view('home.cart.stripe',compact('totalPrice'));
    }
    public function stripePost(Request $request,$totalPrice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => $totalPrice * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thanks for payment" 
        ]); 
        $userId=Auth::user()->id;
        $cartInfo= Cart::where('user_id',$userId)->get();
        foreach ($cartInfo as $data ){
            $order = new Order();
            $order->name=$data->name;
            $order->email=$data->email;
            $order->phone_number=$data->phone_number;
            $order->address=$data->address;
            $order->product_title=$data->product_title;       
            $order->price=$data->price;                        
            $order->image=$data->image;
            $order->quantity=$data->quantity;
            $order->user_id= $data->user_id;
            $order->product_id=$data->product_id;
            $order->payment_status='paid';  
            $order->delivery_status='processing';            
            $order->save();
            $cart_id=$data->id;
            $cart=Cart::find($cart_id);
            $cart->delete();

        }
      
        Session::flash('success', 'Payment successful!');
              
        return back();
    }
    
    
    


    
}  