<!DOCTYPE html>
<html>
   <head>
    {{-- <base href="/public"> --}}
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
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
        @include('home.header')
         <!-- end header section -->
         <!-- slider section -->
      
         <!-- end slider section -->
         @if(session()->has('message'))
         <div class="alert alert-success">

             {{session()->get('message')}}
             {{-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button> --}}

             <span type="button" data-dismiss="alert" aria-hidden="true" aria-label="close">x</span>

         </div>
         @endif
    
      <div class="col-sm-6 col-md-4 col-lg-4" style="margin: auto; width:50%; padding:30px;">
       
           <div class="img-box">
              <img src="/product/{{$pro->image}}" alt="Image not found" style="padding: 20px">
           </div>
           <div class="detail-box">
              <h5>
                {{$pro->title}}
              </h5>

              @if ($pro->discount_price != null)
              <h6>
               <h5> Price after discount: </h5>
                ${{$pro->discount_price}}
             </h6>
             <h6 style="text-decoration: line-through; color:red;">
             <h5 style="text-decoration: line-through; color:red;">  price: 
                ${{$pro->price}}
            </h5> 
             </h6>

             @else
             <h6>
                ${{$pro->price}}
             </h6>

             @endif

             <h6>
              <h5>  Category: </h5> {{$pro->category}}
             </h6>

             <h6>
               <h5>Available Quantity: </h5>{{$pro->quantity}}
             </h6>

             <h6>
             <h5>   Description: </h5>{{$pro->description}}
             </h6>
              <br> <br>
              <form action="{{url('add_cart',$pro->id)}}" method="Post">
               @csrf
               <div class="row">
                  <div class="col-mid-4">
                     <label for="">Quantity:</label>
                     <input type="number" name="quantity" value="1" min="1" style="width: 100px" max="{{$pro->quantity}}">
                  </div>
                  <div class="col-mid-4">
                     
                     <input type="submit" class="option2" value="Add to cart">
                     </div>
               </div>
           
             </form>
           </div>
        </div>
     </div>
     
      
    
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