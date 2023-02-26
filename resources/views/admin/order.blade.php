<!DOCTYPE html>
<html lang="en">
  <head>

        
    <!-- Required meta tags -->
   @include('admin.css')

   <style type="text/css">
   .title_des
   {
    text-align: center;
    font-size: 25px;
    font-weight: bold;
   }
   .table_des
   {
    /* border: 2px solid white;
    width: 100px;
    margin: auto;
    padding-top: 50px;
    text-align: center; */
    margin: auto;
        width: 20%;
        border: 2px solid white;
       
        text-align: center;
        margin-top: 40px;
   }
   .th_style
   {
    padding: 10px;
    background-color: cadetblue;
   }
   </style>
  </head>
  <body>
    <div class="container-scroller">
      <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-md-12 p-0 m-0">
          <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
           
            <div class="d-flex align-items-center justify-content-between">
              <a href="https://www.bootstrapdash.com/product/corona-free/"><i class="mdi mdi-home me-3 text-white"></i></a>
              <button id="bannerClose" class="btn border-0 p-0">
                <i class="mdi mdi-close text-white me-0"></i>
              </button>
            </div>
          </div>
        </div>
       
      </div>
      <!-- partial:partials/_sidebar.html -->
     @include('admin.sidebar')
      <!-- partial -->
      @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
              <h1 class="title_des">All Orders</h1>
              <div style="padding-left: 400px; padding-bottom: 30px;">
                <form action="{{url('search')}}" method="get">
                  @csrf
                  <input type="text" name="search" placeholder="search .." style="color: black">
                  <input type="submit" value="Search" class="btn btn-outline-primary">
                </form>
              </div>
              <table class="table_des">
                <tr>
                    <th class="th_style">Name </th>
                    <th class="th_style">Email </th>
                    <th class="th_style">Address </th>
                    <th class="th_style">Phone </th>
                    <th class="th_style">Product title </th>
                    <th class="th_style">Quantity </th>
                    <th class="th_style">Price </th>
                    <th class="th_style">Payment Status </th>
                    <th class="th_style">Delivery Status </th>
                    <th class="th_style">Image </th>
                    <th class="th_style">Delivered </th>
                    <th class="th_style">Download PDF </th>
                    <th class="th_style">Send Email </th>
                </tr>
                @forelse($orders as $order)
                <tr>
                  <td>{{$order->name}}</td>
                  <td>{{$order->email}}</td>
                  <td>{{$order->address}}</td>
                  <td>{{$order->phone}}</td>
                  <td>{{$order->product_title}}</td>
                  <td>{{$order->quantity}}</td>
                  <td>{{$order->price}}</td>
                  <td>{{$order->payment_status}}</td>
                  <td>{{$order->delivery_status}}</td>
                  <td>
                    <img src="/product/{{$order->image}}" alt="Image not found!">
                  </td>
                  <td>
                    @if($order->delivery_status=='Processing')
                    <a href="{{url('delivered',$order->id)}}" onclick="return confirm('Are you sure this order is deliverd?')" class="btn btn-success">Delivered</a>
                    @else
                    <p style="color:green;"><b>Delivered</b></p>
                    @endif
                  </td>
                  <td>
                    <a href="{{url('print_pdf',$order->id)}}" class="btn btn-primary">Print PDF</a>
                  </td>
                  <td>
                    <a href="{{url('send_email',$order->id)}}" class="btn btn-info">Send Email</a>
                  </td>
                </tr>

                @empty
                    <tr>
                      <td colspan="16">
                        No Data found! Try Search for a right Data.

                      </td>
                    </tr>
                @endforelse
              </table>
            </div>
        </div> 
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
  </body>
</html>