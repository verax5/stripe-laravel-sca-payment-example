

<h3>Basket: </h3>
@foreach(auth()->user()->basket as $basket)
    {{ $basket->product->title }} x {{$basket->quantity}}
    <form action="/products/delete" method="POST">
        <input type="hidden" name="id" value="{{$basket->product->id}}">
        {{ csrf_field() }}
        <button type="submit">Delete</button>
        <input type="hidden" name="_method" value="delete">
    </form>
    <br>
@endforeach
<a href="/orders">Orders</a> <br>
<a href="/checkout">Checkout</a>

<h3> Products </h3>
@foreach($products as $product)
    <form method="POST" action="add-basket" style="width:200px; border:1px solid; padding:10px">
        <h5>{{ $product->title}}</h5> 
        <p>{{ $product->desc }}</p>
        <input type="hidden" name="productId" value="{{$product->id}}">
        {{ csrf_field() }}
        <button type="submit">Add to basket</button>
    </form>
@endforeach