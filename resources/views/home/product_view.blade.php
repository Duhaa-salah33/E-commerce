<section class="product_section layout_padding">
    <div class="container">
       <div class="heading_container heading_center">
        
<br><br>

          <div>
            <form action="{{url('product_search')}}" method="GET">
               @csrf
               <input type="text" style="width: 500px;" name="search" placeholder="Search for something">
               <input type="submit" value="Search" class="btn btn-primary">
            </form>
          
          </div>
          

       </div>

    
       <div class="row">

         @foreach ($product as $pro)
             
          <div class="col-sm-6 col-md-4 col-lg-4">
             <div class="box">
                <div class="option_container">
                   <div class="options">
                      <a href="{{url('/product_details',$pro->id)}}" class="option1">
                      Product details
                      </a>
                      <form action="{{url('add_cart',$pro->id)}}" method="Post">
                        @csrf
                        <div class="row">
                           <div class="col-mid-4">
                              <input type="number" name="quantity" value="1" min="1" style="width: 100px">
                           </div>
                           <div class="col-mid-4">
                              <input type="submit" class="option2" value="Add to cart">
                              </div>
                        </div>
                    
                      </form>
                      {{-- <a href="" class="option2">
                      Buy Now
                      </a> --}}
                   </div>
                </div>
                <div class="img-box">
                   <img src="product/{{$pro->image}}" alt="">
                </div>
                <div class="detail-box">
                   <h5>
                     {{$pro->title}}
                   </h5>

                   @if ($pro->discount_price != null)
                   <h6>
                     Price after discount:
                     <br>
                     ${{$pro->discount_price}}
                  </h6>

                  <h6 style="text-decoration: line-through; color:red;">
                    price: <br>
                     ${{$pro->price}}
                  </h6>
                  @else
                  <h6>
                     ${{$pro->price}}
                  </h6>
                  @endif
                   
                </div>
             </div>
          </div>
          
          @endforeach

          <span style="padding-top:20px;">
          {{-- {!!$product->appends(Request::all())->links()!!} --}}
          {!!$product->withQueryString()->links('pagination::bootstrap-5')!!}
         </span>
    </div>
 </section>