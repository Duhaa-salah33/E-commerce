<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="{{asset('images/favicon.png')}}" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}" />
      <!-- font awesome style -->
      <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{asset('css/style.css')}}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{asset('css/responsive.css')}}" rel="stylesheet" />

      <style type="text/css">
      .center
      {
        margin: auto;
        width: 70%;
        padding: 30px;
      }
      table,th,td{
        border: 1px solid black;
      }
      .th_des
      {
        padding: 10px;
        background-color: skyblue;
        font-size: 20px;
        font-weight: bold;
      }
      </style>
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
        @include('home.header')
         <!-- end header section -->

         <div class="center">
            <table>
                <tr>
                    <th class="th_des">Product title</th>
                    <th class="th_des">Quantity</th>
                    <th class="th_des">Price</th>
                    <th class="th_des">Payment Status</th>
                    <th class="th_des">Delivery Status</th>
                    <th class="th_des">Image</th>
                    <th class="th_des">Action</th>
                </tr>
                @foreach ($order as $or)
                    
               
                <tr>
                    <td>{{$or->product_title}}</td>
                    <td>{{$or->quantity}}</td>
                    <td>{{$or->price}}</td>
                    <td>{{$or->payment_status}}</td>
                    <td>{{$or->delivery_status}}</td>
                    <td>
                     <img height="100" width="180" src="product/{{$or->image}}" alt="Image not found">
                    </td>
                    <td>
                     @if ($or->delivery_status == 'Processing')
                     <a href="{{url('cancel_order',$or->id)}}" class="btn btn-danger">Cancel</a></td>
                     @else
                     <p>You delivered it!</p>
                     @endif
                </tr>

                @endforeach
            </table>
         </div>
       
      </div>
      <!-- why section -->
    <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
      <!-- jQery -->
      <script src="js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="js/custom.js"></script>
   </body>
</html>