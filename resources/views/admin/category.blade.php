<!DOCTYPE html>
<html lang="en">
  <head>

        
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
   }
   .close {
  cursor: pointer;
  position: absolute;
  top: 50%;
  right: 0%;
  padding: 12px 16px;
  transform: translate(0%, -50%);
}
.centre
{
  margin: auto;
  width: 50%;
  text-align: center;
  margin-top: 30px;
  border: 3px solid gray;
  table-layout: auto;
  background-color:cornflowerblue;
}
.close:hover {background: #bbb;}
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
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                 {{session()->get('message')}}
                </div>
                @endif
                
                <div class="div_center">
                   <h2 class="h2_font"> Add Category </h2> 
                   <form action="{{url('/add_category')}}" method="POST">
                    @csrf
                    <input type="text" name="category_name" class="input_color" placeholder="the category">
                    <br>
                    <br>
                    <input type="submit" class="btn btn-primary" name="submit" value="Add Category">
                   </form>
                </div>
                
                <table class="centre">
                  <tr>
                    <td>All Categories</td>
                    <td>Action</td>
                  </tr>
                  
                  @foreach ($data as $d)
                  <tr>
                    <td>{{$d->category_name}}</td>
                    <td>
                      <a onclick="return confirm('Are you sure you want to delete!')" href="{{url('delete_category',$d->id)}}" class="btn btn-danger">Delete</a>
                      
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
  <script src="js/jquery-3.4.1.min.js"></script>
<!-- popper js -->
<script src="js/popper.min.js"></script>
<!-- bootstrap js -->
<script src="js/bootstrap.js"></script>
<!-- custom js -->
<script src="js/custom.js"></script>
</html>