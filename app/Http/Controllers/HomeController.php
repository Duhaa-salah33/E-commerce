<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Comment;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;
use Stripe;




class HomeController extends Controller
{
    public function redirect()
    {
        $usertype = Auth::user()->usertype;
        if($usertype== '1')
        {
            $total_product = Product::all()->count();
            $total_order = Order::all()->count();
            $total_user = User::all()->count();
            $orders = Order::all();
            $total_revenue = 0;
            foreach($orders as $order)
            {
                $total_revenue = $total_revenue + $order->price;
            }
            $total_delivered = Order::where('delivery_status','Delivered')->get()->count();
            $total_processing = Order::where('delivery_status','Processing')->get()->count();
            return view('admin.home',compact('total_product','total_order','total_user','total_revenue','total_delivered','total_processing'));
        }
        else
        {
        $product = Product::paginate(3);
       
        $comments = Comment::all();
        return view('home.userpage',compact('product','comments'));
        }

       
            // if(!empty(Auth::user()) && Auth::user()->usertype == 1 ){
            //     return view('admin.home');
            // }
            // $product = Product::paginate(3);
            // return view('home.userpage',compact('product'));
        
    }
    public function index()
    {
        $product = Product::paginate(3);
        return view('home.userpage',compact('product'));
    }

    public function cart_count()
    {

        $user = Auth::user();
        $userid = $user->id;
        $cart = Cart::where('user_id',$userid);
        return view('home.header',compact('cart'));
    }

    // public function logout(Request $request)
    // {
    //     Auth::logout();
    //    $request->session()->invalidate();
     
    //     $request->session()->regenerateToken();
     
    //     return redirect('/');
    //     // Session::flush();
            
    //     //     Auth::logout();
    
    //     //     return redirect('login');
    // }

    public function product_details($id)
    {
        $pro = Product::find($id);
        return view('home.product_details',compact('pro'))->with('message','Product added successfully!');
    }

    public function add_cart(Request $request,$id)
    {
        if(Auth::id())
        {
            $user = Auth::user();
            $product = Product::find($id);
            
            $userid = $user->id;
            $product_exist_id = Cart::where('Product_id',$id )->where('user_id',$userid)->get('id')->first();

            if($product_exist_id!=null)
            {
                $cart = Cart::find($product_exist_id)->first();
                $quantity = $cart->quantity;
                $cart->quantity = $quantity + $request->quantity;
            if($product->discount_price != null)
            {
                $cart->price = $product->discount_price * $cart->quantity;
            }
            else
            {
                $cart->price = $product->price * $cart->quantity;
            }
                $cart->save();
                // Alert::info || warning || success 
                Alert::success('Product Added Successfully','We have added product to the cart');
                return redirect()->back()->with('message','Prodect added successfully!');
            }
            else
            {
            $cart = new Cart();
            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->user_id = $user->id;

            $cart->product_title = $product->title;
            if($product->discount_price != null)
            {
                $cart->price = $product->discount_price * $request->quantity;
            }
            else
            {
                $cart->price = $product->price * $request->quantity;
            }
            $cart->image = $product->image;
            $cart->Product_id = $product->id;

            $cart->quantity = $request->quantity;

            $cart->save();
            return redirect()->back()->with('message','Product added successfully');
        }
        }
        
        else
        {
            return redirect('login');
        }
    }

    public function show_cart()
    {
        if(Auth::id())
        {
            $id = Auth::user()->id;
            $cart = Cart::where('user_id',$id)->get();
            return view('home.showCart',compact('cart'));
        }
        else
        return redirect('login');

    }

    public function remove_cart($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        Alert::warning('Deleted Successfully!','the selected order has been deleted');

        return redirect()->back();
    }
  
    public function cash_order()
    {
        $user = Auth::user();
        $userid = $user->id;
        $data = Cart::where('user_id',$userid)->get();
        foreach($data as $da)
        {
            $order = new Order();
            $order->name = $da->name;
            $order->email = $da->email;
            $order->phone = $da->phone;
            $order->address = $da->address;
            $order->user_id = $da->user_id;
            $order->product_title = $da->product_title;
            $order->price = $da->price;
            $order->quantity = $da->quantity;
            $order->image = $da->image;
            $order->product_id = $da->Product_id;
            $order->payment_status = 'Cash on delivery';
            $order->delivery_status ='Processing';
            $order->save();

            $cart_id = $da->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }
        return redirect()->back()->with('message','We received your order!You will get it soon!');
    }

    public function stripe($totalPrice)
    {
        return view('home.stripe',compact('totalPrice'));
    }

    public function stripePost(Request $request,$totalPrice)
    {
       
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => $totalPrice * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com." 
        ]);

        $user = Auth::user();
        $userid = $user->id;
        $data = Cart::where('user_id',$userid)->get();
        foreach($data as $da)
        {
            $order = new Order();
            $order->name = $da->name;
            $order->email = $da->email;
            $order->phone = $da->phone;
            $order->address = $da->address;
            $order->user_id = $da->user_id;
            $order->product_title = $da->product_title;
            $order->price = $da->price;
            $order->quantity = $da->quantity;
            $order->image = $da->image;
            $order->product_id = $da->Product_id;
            $order->payment_status = 'Paid by card';
            $order->delivery_status ='Processing';
            $order->save();

            $cart_id = $da->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }
      
        Session::flash('success', 'Payment successful!');
              
        return back();
    }

    public function show_order()
    {
        if(Auth::id())
        {
            $user = Auth::user();
            $userid = $user->id;

            $order = Order::where('user_id',$userid)->get();
            return view('home.order',compact('order'));
        }
        else
        {
           return redirect('login');
        }
    }

    public function cancel_order($id)
    {
        $order = Order::find($id);
        $order->delete();
               // $order->delivery_status = "You cancel the order";
       return redirect()->back();
    }

    public function add_comment(Request $request)
    {
        if(Auth::id())
        {
            $comment = new Comment();
            $comment->name = Auth::user()->name;
            $comment->user_id = Auth::user()->id;
            $comment->comment = $request->comment;
            $comment->save();
            return redirect()->back();
        }
        else
        {
            return redirect('login');
        }

    }

    public function product_search(Request $request)
    {
        $search_text = $request->search;
        $product = Product::where('title','LIKE',"%$search_text%")->orWhere('category','LIKE',"$search_text")->paginate(10);
        return view('home.all_products',compact('product'));
    }

    public function products()
    {
        $product = Product::paginate(3);
        return view('home.all_products',compact('product'));
    }

    public function search_product(Request $request)
    {
        $search_text = $request->search;
        $product = Product::where('title','LIKE',"%$search_text%")->orWhere('category','LIKE',"$search_text")->paginate(10);
        return view('home.userpage',compact('product'));
    }
}




