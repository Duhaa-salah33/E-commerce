<!DOCTYPE html>
<html lang="en">
  <head>

    <!-- Required meta tags -->
    {{-- <base href="/public"> --}}

   @include('admin.css')

   <style type="text/css">
    .center
    {
        margin: auto;
        width: 50%;
        border: 2px solid white;
        background-color: cadetblue;
        text-align: center;
        margin-top: 40px;
    }
    .font_size
   {
    text-align: center;
    font-size: 40px;
    padding-top: 40px;
    font-family: sans-serif;
   }
   .font_style
   {
    color: black;
    background-color: azure;
   }
   .th_style
   {
    padding: 30px;
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
                @if(session()->has('message'))
                <div class="alert alert-success">

                    {{session()->get('message')}}
                    {{-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button> --}}

                    <span class="close" type="button" aria-hidden="true" data-dismiss="alert" aria-hidden="true" aria-label="close">x</span>

                </div>
                @endif
                <h2 class="font_size">All Products</h2>
                <table class="center">
                    <tr class="font_style">
                        <th class="th_style">Title</th>
                        <th class="th_style">Description</th>
                        <th class="th_style">Quantity</th>
                        <th class="th_style">Category</th>
                        <th class="th_style">Price</th>
                        <th class="th_style">Discount Price</th>
                        <th class="th_style">Image</th>
                        <th class="th_style">Action</th>
                    </tr>
                    @foreach($product as $pro)
                    <tr>
                        <td>{{$pro->title}}</td>
                        <td>{{$pro->description}}</td>
                        <td>{{$pro->quantity}}</td>
                        <td>{{$pro->category}}</td>
                        <td>{{$pro->price}}</td>
                        <td>{{$pro->discount_price}}</td>
                        <td>
                            <img class="" src="/product/{{$pro->image}}" alt="image not found">
                        </td>
                        <td>
                            <a onclick="return confirm('Are you sure you want to delete!')" href="{{url('delete_product',$pro->id)}}" class="btn btn-danger">Delete</a>
                            <br> <br>
                            <a href="{{url('update_product',$pro->id)}}" class="btn btn-success"> Edit </a>

                      </td>
                    </tr>
                    @endforeach
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