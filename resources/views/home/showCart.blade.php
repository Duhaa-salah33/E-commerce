<!DOCTYPE html>
<html>
   <head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
            width: 50%;
            text-align: center;
            padding: 30px;
        }
        table,th,td{
            border: 1px solid grey;
        }
        .close 
        {
            cursor: pointer;
            position: absolute;
            top: 50%;
            right: 0%;
            padding: 12px 16px;
            transform: translate(0%, -50%);
        }
  
        .img_style
        {
            width: 100px;
            height: 100px;
        }
        .th_deg
        {
            width: 300px;
            font-size: 30px;
            padding: 5px;
            background: steelblue;
        }
        .total_deg
        {
            font-size: 20px bold;
            padding: 40px;
        }
      </style>
   
    </head>
   <body>
    @include('sweetalert::alert')

      <div class="hero_area">
         <!-- header section strats -->
        @include('home.header')
         <!-- end header section -->
       @if(session()->has('message'))
       <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        {{session()->get('message')}}
       </div>
       @endif
      </div>
      
      <div class="center">
        <table>
            <tr>
                <th class="th_deg">Product Title</th>
                <th class="th_deg">Product Quantity</th>
                <th class="th_deg">Price</th>
                <th class="th_deg">Image</th>
                <th class="th_deg">Action</th>
            </tr>
            <?php $totalPrice = 0; ?>
            @foreach($cart as $car)
            <tr>
                <th>{{$car->product_title}}</th>
                <th>{{$car->quantity}}</th>
                <th>{{$car->price}}</th>
                <th>
                    <img class="img_style" src="/product/{{$car->image}}" alt="image not found!">
                </th>
                <th>
                    <a href="{{url('/remove_cart',$car->id)}}" class="btn btn-danger" onclick="confirmation(event)">Remove</a>
                </th>
            </tr> 
            <?php $totalPrice = $totalPrice + $car->price ?>
            @endforeach
            
        </table>
        <div>
            <h1 class="total_deg">Total Price: {{$totalPrice}}</h1>
            
        </div>
        <div>
            <h1 class="total_deg">Proceed to Order</h1>
            <a href="{{url('cash_order')}}" class="btn btn-primary">Pay Cash on delivery</a>
            <a href="{{url('stripe',$totalPrice)}}" class="btn btn-success">Pay using Card</a>
        </div>
      </div>

      <!-- footer start -->
    
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>


      <script>
        function confirmation(ev)
        {
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            console.log(urlToRedirect);
            swal({
                title: "Are you sure to cancel this product?",
                text: "You will not be abled to revent this!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willCancel) => {
                if(willCancel){
                    window.location.href = urlToRedirect;
                }
                 
            });
        }
      </script>

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