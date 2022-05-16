
@foreach($products as $product)
<div class="card">
  <img class="card-img-top" src="..{{ $product->image }}" alt="dummy">
  <div class="card-body">
    <h5 class="card-title">{{$product->name}}</h5>
    <p class="card-text">{{$product->description}}</p>
    <p class="card-text"><b>Price:</b> {{$product->price}}</p>
    <p class="card-text"><b>Sale price:</b> {{$product->sale_price}}</p>
    <p class="card-text"><b>Stock:</b> {{$product->stock}}</p>
    <a href="{{ route('add.to.cart', $product->id) }}"><button class="btn btn-primary">Add to cart</button></a>
  </div>
</div>
@endforeach
