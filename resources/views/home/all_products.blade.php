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
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   </head>
   <body>
      <div class="hero_area">
        
         <!-- header section strats -->
        @include('home.header')
         <!-- end header section -->
      
      <!-- product section -->
      @include('home.product_view')
      <!-- end product section -->

      {{-- Comments and reply section starts here !! --}}
      <div style="text-align: center; padding-bottom: 30px;">
         <h1 style="font-size: 30px; text-align: center; padding-top: 20px; padding-bottom: 20px; ">
            Comments
         </h1>
         <form action="{{url('add_comment')}}" method="POST">
            @csrf
            <textarea name="comment" id="" style="height: 150px; width: 600px;" placeholder="Write your comment here!"></textarea>
            <br>
            <input type="submit" class="btn btn-success" value="Comment"> 
        </form>
      </div>

      <div style="text-align: center; padding-bottom: 30px;">
         <h1 style="font-size: 30px; text-align: center; padding-top: 20px; padding-bottom: 20px; ">All Comments</h1>
         {{-- @foreach ($comments as $comment)
         <div>
            
            <b>{{$comment->name}}</b>
            <p>{{$comment->comment}}</p>
            <a href="javascript::void(0);" onclick="reply(this)" style="color: green">Reply</a>
            
         </div>
         @endforeach --}}
         
         <div>
            <b>Duha</b>
            <p>This is my first comment till now</p>
            <a href="javascript::void(0);" onclick="reply(this)" style="color: green" >Reply</a>
         </div>
         

      </div>

      <div style="text-align: center; display:none;" class="replyDiv">
         <textarea name="comment" id="" placeholder="reply with a comment .."></textarea>
         <a href="" class="btn btn-success">Reply</a>
         <a href="javascript::void(0);" class="btn btn-danger" onclick="reply_close(this)">Close</a>
      </div>
      {{-- Comments and reply section ends here!!! --}}
     
      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>

      <script type="text/javascript">
      function reply(caller)
      {
         $('.replyDiv').insertAfter($(caller));
         $('.replyDiv').show();
      }

      function reply_close(caller)
      {
         $('.replyDiv').hide();
      }
      
      </script>
       <script>
         document.addEventListener("DOMContentLoaded", function(event) { 
             var scrollpos = localStorage.getItem('scrollpos');
             if (scrollpos) window.scrollTo(0, scrollpos);
         });
 
         window.onbeforeunload = function(e) {
             localStorage.setItem('scrollpos', window.scrollY);
         };
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
