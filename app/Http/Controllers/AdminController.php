<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Notifications\SendEmailNotification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Notification;
//use PDF;


class AdminController extends Controller
{
    public function view_category()
    {
        if(Auth::id())
        {
            $data = Category::all();
        return view('admin.category',compact('data'));
        }
        else
        {
            return redirect('login');
        }
        
    }
    public function add_category(Request $request)
    {
        $data = new Category();
        $data->category_name = $request->category_name;
        $data->save();
        return redirect()->back()->with('message','Category Added Successfully!');
    }
    public function delete_category($id)
    {
        $data= Category::find($id);
        $data->delete();
        return redirect()->back()->with('message','Category Deleted Successfully!');
    }
    public function add_product(Request $request)
    {
        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->discount_price = $request->discount_price;
        $product->category = $request->category;

        $image = $request->image;
        $imagename = time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product',$imagename);
        $product->image = $imagename;
        $product->save();
        return redirect()->back()->with('message','A new Product has been added successfully!');
    }
    public function view_product()
    {
        $category = Category::all();
        return view('admin.product',compact('category'));
    }

    public function show_product()
    {
        $product = Product::all();
        return view('admin.AllProducts',compact('product'));
    }

    public function delete_product($id)
    {
        $product = Product::find($id);
      //  $image_path = public_path("product").$product->image;
      $image_path = 'product'.$product->image;
        // if(File::exists($image_path))
        // {
        //     File::delete($image_path);
        // }
        // $product->delete();
       // Storage::delete($product->image);
        Storage::delete($image_path);
        $product->delete();
        return redirect()->back()->with('message','Product has been deleted successfully!');
    }
    public function update_product($id)
    {
        $product = Product::find($id);
        $category = Category::all();
       
        return view('admin.editProduct',compact('product' , 'category'));
    }
    public function edit_product(Request $request, $id)
    {
        if(Auth::id())
        {
            $product = Product::find($id);
            $product->title = $request->title;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->discount_price = $request->discount_price;
            $product->category = $request->category;
    
            $image = $request->image;
            if($image)
            {
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('product',$imagename);
            $product->image = $imagename;
            }
            $product->save();
           return redirect()->back()->with('message','Product has been updated successfully!');
           
        }
        else return redirect('login');
 //return view('admin.AllPro ducts');
        //return view('admin.AllProducts')->with('message','Product has been updated successfully!');
    }

    public function order()
    {
        $orders =Order::all();
        return view('admin.order',compact('orders'));
    }

    public function delivered($id)
    {
        $order = Order::find($id);
        $order->delivery_status = "Delivered";
        $order->payment_status = "Paid";
        $order->save();
        return redirect()->back();
    }

    public function print_pdf($id)
    {
        $order = Order::find($id);
        $pdf = PDF::loadView('admin.pdf',compact('order'));
       return $pdf->download('order_details.pdf');

    }

    public function send_email($id)
    {
        $order = Order::find($id);
        return view('admin.email_info',compact('order'));
    }

    public function send_user_email(Request $request,$id)
    {
        $order = Order::find($id);
        $details =[
            'greeting' => $request->greeting,
            'firstline' => $request->firstline,
            'body' => $request->body,
            'button' => $request->button,
            'url' => $request->url,
            'lastline' => $request->lastline
        ];
        //Notification::send($users, new InvoicePaid($invoice));
        Notification::send($order,new SendEmailNotification($details));
        return redirect()->back();
    }

    public function searchData(Request $request)
    {
        $searchText = $request->search;
        $orders = Order::where('name','LIKE',"%$searchText%")->orWhere('phone','LIKE',"%$searchText%")->get();
        return view('admin.order',compact('orders'));
    }

}
