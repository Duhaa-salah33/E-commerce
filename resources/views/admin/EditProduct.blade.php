<!DOCTYPE html>
<html lang="en">
  <head>

        <base href="/public">
    <!-- Required meta tags -->
   @include('admin.css')

   <style type="text/css">
    .div_center
  {
   text-align: center;
   padding-top: 40px;
  }
  .h2_font
  {
   font-size: 40px;
   padding-bottom: 40px;
   font-family: sans-serif;
  }
  .input_color
  {
   color:black;
   padding-bottom: 20px;
  }
  label
  {
   display: inline-block;
   width: 200px;
  }
  .div_design
  {
   padding-bottom: 15px;
  }
  .img
  {
     margin: auto;
     width: 200px;
     height: 200px;

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

                    <span type="button" data-dismiss="alert" aria-hidden="true" aria-label="close">x</span>

                </div>
                @endif
                <div class="div_center">
                    <h1 class="h2_font">Edit Product</h1>
                    <form action="{{url('/edit_product',$product->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                <div class="div_design">
                    <label>Title : </label>
                    <input class="input_color" type="text" name="title" placeholder="Product title .." value="{{$product->title}}" required>
                </div>

                <div class="div_design">
                    <label>Description : </label>
                    <input class="input_color" type="text" name="description" placeholder="Product Description .." value="{{$product->description}}" required>
                </div>

                <div class="div_design">
                    <label>Price : </label>
                    <input class="input_color" type="number" name="price" placeholder="Product price .." value="{{$product->price}}" required>
                </div>

                <div class="div_design">
                    <label>Discount Price :</label>
                    <input class="input_color" type="number" name="discount_price" placeholder="Discount price .." value="{{$product->discount_price}}" required>
                </div>

                <div class="div_design">
                    <label>Quantity : </label>
                    <input class="input_color" type="number" min="0" name="quantity" placeholder="Product Quantity .." value="{{$product->quantity}}" required>
                </div>

                <div class="div_design">
                    <label>Product Category : </label>
                    <select name="category" id="" class="input_color" required>
                        <option value="{{$product->category}}" selected="">{{$product->category}}</option>
                        @foreach ($category as $cat)
                        <option value="">{{$cat->category_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="div_design">
                    <label>Product Image : </label>
                    <img class="img" src="/product/{{$product->image}}" alt="image not found!">
                </div>

                <div class="div_design">
                    <label>Change Image : </label>
                    <input type="file" name="image">
                </div>
                <br>
                <div class="div_design">
                    <input type="submit" class="btn btn-success" value="Update Product">
                </div>
            </form>
                </div>
            </div>
        </div>

      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
  </body>
  <script src="js/jquery-3.4.1.min.js"></script>
<!-- popper js -->
<script src="js/popper.min.js"></script>
<!-- bootstrap js -->
<script src="js/bootstrap.js"></script>
<!-- custom js -->
<script src="js/custom.js"></script>
</html>