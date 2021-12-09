@extends('layouts.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<title>Cart List</title>
<main>
    @if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @elseif(session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
    @endif
    <!-- Quantity Modal -->
    <div class="modal fade" id="editQuantity" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Adjust your quantity</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                </div>

                <form id="editQty">
                    <div class="modal-body">
                        {{csrf_field()}}
                        {{method_field('PUT')}}

                        <input type="hidden" name="id" id="id">

                        <label class="form-label">Quantity:</label>
                        <input type="number" name="cartQuantity" class="form-control" id="cartQuantity"
                            min="1" />
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end of Quantity Modal -->

    <form action="{{route('select.item.order', $userCart)}}" method="post">
        {{csrf_field()}}
        {{method_field('POST')}}
        <div class="container-fluid px-4">
            <h1 class="mt-4">Cart List</h1>
            <ol class="breadcrumb mb-4">
                @can('Dashboard-list')
                <li class="breadcrumb-item"><a href="{{ route('adminHome') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Cart</li>
                @endcan
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
                                <th>Select Item</th>
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
                            @foreach($carts as $cart)
                            <tr id="sid{{$cart->id}}">
                                <td>
                                    <input class="form-check-input cbox" type="checkbox" name="selected_item[]"
                                        value="{{$cart->id}}" data-price="{{$cart->subTotal}}">
                                    <p style="text-indent:100%;white-space:nowrap;overflow:hidden;">{{$cart->id}}</p>
                                    </input>
                                </td>
                                <td><b>{{$cart->productName}}</b></td>
                                <td>{{$cart->productSize}}</td>
                                <td>{{$cart->productBrand}}</td>
                                <td>{{$cart->productCategory}}</td>
                                <td>RM{{$cart->productPrice}}</td>
                                <td>{{$cart->cartQuantity}}</td>
                                <td>RM{{$cart->subTotal}}</td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <a href="#" class="btn btn-primary editbtn">Edit Quantity</a>

                                    <a href="javascript:void(0)" onclick="remove({{$cart->id}})"
                                        class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>

                        <td colspan="9" class="text-right">

                            <h3>
                                Total: RM<input style="border:none;outline:none;" type="text" readonly id="msg" />
                            </h3>
                        </td>

                    </table>

                    <a href="{{ route('product.index') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i>
                        Continue
                        Shopping</a>
                </div>
            </div>

            @if($carts->count() == 0)
            <p></p>
            @else
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-header" style="background-color: green;">
                        <h3 class="text-center font-weight-bold my-4" style="color: white;">Order Detail</h3>
                    </div>
                    <div class='form-row row'>
                        <div class='col-xs-12 form-group'>
                            <label class='control-label'>Name</label>
                            <input class='form-control' name='paymentName' type='text'>
                            <div class="alert-danger">{{$errors->first('paymentName')}}</div>
                        </div>
                    </div>

                    <div class='form-row row'>
                        <div class='col-xs-12 form-group'>
                            <label class='control-label'>Email</label>
                            <input class='form-control' name='paymentEmail' type='text'>
                            <div class="alert-danger">{{$errors->first('paymentEmail')}}</div>
                        </div>
                    </div>

                    <div class='form-row row'>
                        <div class='col-xs-12 form-group'>
                            <label class='control-label'>Address</label>
                            <input class='form-control' name='paymentAddress' type='text'>
                            <div class="alert-danger">{{$errors->first('paymentAddress')}}</div>
                        </div>
                    </div>

                    <div class='form-row row'>
                        <div class='col-xs-12 form-group'>
                            <label class='control-label'>Phone Number</label>
                            <input class='form-control' name='paymentPhoneNumber' type='text'>
                            <div class="alert-danger">{{$errors->first('paymentPhoneNumber')}}</div>
                        </div>
                    </div>
                    </br>
                    <button type="submit" class="btn btn-success">
                        Checkout
                    </button>
                </div>
            </div>
            @endif

        </div>

    </form>

</main>


<script>
//calculate total
$(function() {
    $(".cbox").on("change", function() {
        const vals = $(".cbox:checked")
            .map(function() {
                return +this.dataset.price
            })
            .get();
        // test we have an array of values
        const sum = vals.length > 0 ? vals.reduce((a, b) => a + b) : 0; // if no, zero sum
        $('#msg').val(sum)
    });
});

//update quantity modal
$(document).ready(function() {
    $('.editbtn').on('click', function() {
        $('#editQuantity').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        console.log(data);

        $('#id').val(data[0]);
        $('#cartQuantity').val(data[6]);
    });

    $('#editQty').on('submit', function(e) {
        e.preventDefault();

        var id = $('#id').val();

        $.ajax({
            type: "PUT",
            url: "update-cart/" + id,
            data: $('#editQty').serialize(),
            success: function(response) {
                console.log(response);
                $('#editQuantity').modal('hide');
                location.reload();
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
});

//delete using ajax
function remove(id) {
    if (confirm("Do you want to delete?")) {
        $.ajax({
            url: 'delete-cart/' + id,
            type: 'DELETE',
            data: {
                _token: $("input[name=_token]").val()
            },
            success: function(response) {
                $("#sid" + id).remove();
                location.reload();
            }
        });
    }
}
</script>


@endsection