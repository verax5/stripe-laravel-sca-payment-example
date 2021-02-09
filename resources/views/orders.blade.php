
<h3>Orders: </h3>

<a href="/products">Products</a> <br>

@foreach(auth()->user()->purchases as $item)
    {{ $item->product->title }} 
    Status: {!! $item->status == null ? '<span style="color:red">pending</span>': '<span style="color:green;">'. $item->status . '</span>' !!} 
    
    <hr>
@endforeach