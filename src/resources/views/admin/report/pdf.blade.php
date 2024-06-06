<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>Document</title>
</head>
<body>
    <h1></h1>
    <h3> {{ $order->name }}</h3>
    <h3> {{ $order->email }}</h3>
    <h3> {{ $order->phone_number }}</h3>
    <h3> {{ $order->address }}</h3>
    <h3> {{ $order->product_title }}</h3>
    <h3> {{ $order->quantity }}</h3>
    <h3> {{ $order->price }}</h3>
    <div>
        <img src="{{ $order->image }}" >

    </div>
  
</body>
</html>