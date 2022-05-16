<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <table class="table">
            <thead>
                <tr>
                    <th style="width:30%">ID</th>
                    <th style="width:30%">UserID</th>
                    <th style="width:30%">Created at</th>
                    <th style="width:10%"></th>
                </tr>
            </thead>
        </table>
        @foreach($orders as $o => $order_details)
        <div class="{{ $order_details['isDeleted'] ==  1 ? 'deleted' : 'active'  }}">
            <table class="table">
                <thead class="bg-primary">
                    <tr data-id="{{$order_details['id']}}">
                        <th style="width:30%">{{$order_details['id']}}</th>
                        <th style="width:30%">{{$order_details['user_id']}}</th>
                        <th style="width:20%">{{$order_details['created_at']}}</th>
                        @if(!$order_details['isDeleted'])
                        <th style="width:20%"><button class="btn btn-danger btn-sm delete-order">Delete order</button></th>
                        @else
                        <th style="width:20%">{{$order_details['updated_at']}}</th>
                        @endif
                    </tr>
                </thead>
            </table>
            <table id="order" class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th style="width:50%">Product</th>
                        <th style="width:10%">Price</th>
                        <th style="width:8%">Quantity</th>
                        <th style="width:22%" class="text-center">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0 @endphp
                        @foreach(json_decode($order_details['datas'], true) as $id => $details)
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
                                <td data-th="Quantity">{{ $details['quantity'] }}</td>
                                <td data-th="Subtotal" class="text-center">${{ $details['price'] * $details['quantity'] }}</td>
                            </tr>
                        @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="text-right"><h3><strong>Total ${{ $total }}</strong></h3></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        @endforeach
        </div>
    </div>
</x-app-layout>
<script>
$(".delete-order").click(function (e) {
        e.preventDefault();
  
        var ele = $(this);
  
        if(confirm("Are you sure want to delete?")) {
            axios.post('delete-order', {
            _token: '{{ csrf_token() }}',
            id: ele.parents("tr").attr("data-id"),
            _method: 'patch'
        }).then(response => {  
                window.location.reload();
        });
        }
    });
</script>
<style>
.deleted{
    background-color: red;
    border:3px solid black;
    margin:15px 0;
}
.active{
    border:3px solid black;
    margin:15px 0;
}
    </style>