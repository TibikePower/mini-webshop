<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cart') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <table id="cart" class="table table-hover table-condensed">
            <thead>
                <tr>
                    <th style="width:50%">Product</th>
                    <th style="width:10%">Price</th>
                    <th style="width:8%">Quantity</th>
                    <th style="width:22%" class="text-center">Subtotal</th>
                    <th style="width:10%"></th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0 @endphp
                @if(session('cart'))
                    @foreach(session('cart') as $id => $details)
                        @php $total += $details['price'] * $details['quantity'] @endphp
                        <tr data-id="{{ $id }}">
                            <td data-th="Product">
                                <div class="row">
                                    <div class="col-sm-3 hidden-xs"><img src="{{ $details['image'] }}" width="100" height="100" class="img-responsive"/></div>
                                    <div class="col-sm-9">
                                        <h4 class="nomargin">{{ $details['name'] }}</h4>
                                    </div>
                                </div>
                            </td>
                            <td data-th="Price">${{ $details['price'] }}</td>
                            <td data-th="Quantity">
                                <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity update-cart" />
                            </td>
                            <td data-th="Subtotal" class="text-center">${{ $details['price'] * $details['quantity'] }}</td>
                            <td class="actions" data-th="">
                                <button class="btn btn-danger btn-sm remove-from-cart">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" class="text-right"><h3><strong>Total ${{ $total }}</strong></h3></td>
                </tr>
                @if(session('cart') && count(session()->get('cart'))>0)
                <tr>
                    <td colspan="5" class="text-right">
                        <a href="{{ route('checkout') }}"><button class="btn btn-success">Checkout</button></a>
                    </td>
                </tr>
                @endif
            </tfoot>
        </table>
        </div>
    </div>
</x-app-layout>
<script type="text/javascript">
  
    $(".update-cart").change(function (e) {
        e.preventDefault();
  
        var ele = $(this);
  
        axios.post('update-cart', {
            _token: '{{ csrf_token() }}', 
            id: ele.parents("tr").attr("data-id"), 
            quantity: ele.parents("tr").find(".quantity").val(),
            _method: 'patch'
        }).then(response => {  
                window.location.reload();
        });
    });
  
    $(".remove-from-cart").click(function (e) {
        e.preventDefault();
  
        var ele = $(this);
  
        if(confirm("Are you sure want to remove?")) {
            axios.delete('remove-from-cart', {params: {'id': ele.parents("tr").attr("data-id")}}).then(response => {  
                window.location.reload();
            });
        }
    });
  
</script>