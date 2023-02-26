<html>
    <head>
        Oreder PDF
    </head>
    <body>
        <h1>Order Details</h1>
        Customer email: <h3>{{$order->email}}</h3>
        Customer Name: <h3>{{$order->name}}</h3>
        Customer address: <h3>{{$order->address}}</h3>
        Customer phone: <h3>{{$order->phone}}</h3>
<br>
        Product image: 
        <h3>
            <img src="product/{{$order->image}}" alt="image not found!">
        </h3>
        Product title: <h3>{{$order->product_title}}</h3>
        Product quantity: <h3>{{$order->quantity}}</h3>
        <br>
        Order costs: <h3>${{$order->price}}</h3>
        <br>
        Payment status: <h3>{{$order->payment_status}}</h3>
        Delivery status: <h3>{{$order->delivery_status}}</h3>
       
    </body>
</html>