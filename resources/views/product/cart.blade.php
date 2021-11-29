@extends('layouts.app')

@section('content')

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Cart List</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('adminHome')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Cart</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Cart List
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Size</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Operation</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0 @endphp
                        @foreach($b as $cart)
                        @php $total += $cart['price'] * $cart['quantity'] @endphp
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-sm-9">
                                        <h4 class="nomargin">{{$cart['prodName']}}</h4>
                                    </div>
                                </div>
                            </td>
                            <td>{{$cart['size']}}</td>
                            <td>{{$cart['brands']}}</td>
                            <td>{{$cart['Category']}}</td>
                            <td>RM{{$cart['price']}}</td>
                            <td>
                                <input type="number" value="{{$cart['quantity']}}"
                                    class="form-control quantity update-cart" />
                            </td>
                            <td data-th="Subtotal">RM{{$cart['subTotal']}}</td>
                            <td class="actions" data-th="">
                                <button class="btn btn-danger btn-sm remove-from-cart"><i
                                        class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>

                    <td colspan="8" class="text-right">
                        <h3><strong>Total RM{{ $total }}</strong></h3>
                    </td>

                </table>
             
                <a href="{{ route('product.index') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                <button class="btn btn-success">Checkout</button>

            </div>
        </div>
    </div>
</main>

@endsection

@section('scripts')
<script type="text/javascript">
$(".update-cart").change(function(e) {
    e.preventDefault();

    var ele = $(this);

    $.ajax({
        url: '{{ route('update.cart') }}',
        method: "patch",
        data: {
            _token: '{{ csrf_token() }}',
            id: ele.parents("tr").attr("data-id"),
            quantity: ele.parents("tr").find(".quantity").val()
        },
        success: function(response) {
            window.location.reload();
        }
    });
});

$(".remove-from-cart").click(function(e) {
    e.preventDefault();

    var ele = $(this);

    if (confirm("Are you sure want to remove?")) {
        $.ajax({
            url: '{{ route('delete.cart') }}',
            method: "DELETE",
            data: {
                _token: '{{ csrf_token() }}',
                id: ele.parents("tr").attr("data-id")
            },
            success: function(response) {
                window.location.reload();
            }
        });
    }
});
</script>
@endsection