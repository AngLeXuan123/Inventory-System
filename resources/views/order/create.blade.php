@extends('layouts.app')
@section('content')

<html>
<title>Create New Order</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<body class="bg-primary">
    <main>
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5" style="margin:-15px -15px -15px -15px">
                                    <div class="card-header">
                                        <h3 class="text-center font-weight-bold my-4">Add a New Order</h3>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('order.store') }}" method="POST">
                                            @csrf
                                            @if(Session::has('flash_message'))
                                            <div class="alert alert-success">
                                                {{ Session::get('flash_message')}}
                                            </div>
                                            @endif

                                            @if($errors->any())
                                            <div>
                                                @foreach($errors->all() as $error)
                                                <p>{{$error}}</p>
                                                @endforeach
                                            </div>
                                            @endif

                                            <label for="" class="col-md-4 col-form-label text-md-right"><b>Customer
                                                    Name</b></label>

                                            <input type="text" name="custName" class="form-control"
                                                placeholder="Full Name">

                                            <label for="" class="col-md-4 col-form-label text-md-right"><b>Customer
                                                    Email</b></label>

                                            <input type="text" name="email" class="form-control"
                                                placeholder="Email">

                                            <label for=""
                                                class="col-md-4 col-form-label text-md-right"><b>Address</b></label>

                                            <input type="text" name="address" class="form-control"
                                                placeholder="Address">

                                            <label for="" class="col-md-4 col-form-label text-md-right"><b>Phone
                                                    Number</b></label>

                                            <input type="text" name="phoneNum" class="form-control"
                                                placeholder="Phone Number">

                                            </br>

                                            <table class="table table-bordered">
                                                <thead>
                                                    <th>Product Name</th>
                                                    <th>Quantity</th>
                                                    <th>Total Amount</th>
                                                    <th><a href="#" class="btn btn-primary addRow"><i class="fas fa-plus"></i></a></th>
                                                </thead>

                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <select name="product_id[]" class="form-control">
                                                                @foreach($prod as $prods)
                                                                <option name="product_id[]" value="{{$prods->id}}">{{$prods->prodName}}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="number" name="order_quantity[]"
                                                                class="form-control" placeholder="Quantity" min="0">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="tAmount[]" class="form-control"
                                                                placeholder="Total Amount">
                                                        </td>
                                                        <td>
                                                            <a href="#" class="btn btn-danger"><i
                                                                    class="fas fa-minus"></i></a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button type="submit" class="btn btn-primary">
                                                    Submit
                                                </button>
                                                <a href="{{route('order.index')}}">Back to Order List.</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </main>
</body>
<script type="text/javascript">
$(document).ready(function() {
    $('.addRow').on('click', function() {
        addRow();
    });

    function addRow() {
        var tr = '<tr>' +
                    '<td>' +
                        '<select name="product_id[]" class="form-control">' + 
                            '@foreach($prod as $prods)' +
                            '<option name="product_id[]" value="{{$prods->id}}">{{$prods->prodName}}</option>' +
                            '@endforeach' +
                        '</select>' +
                    '</td>' +
                    '<td>' +
                        '<input type="number" name="order_quantity[]" class="form-control" placeholder="Quantity" min="0">' +
                    '</td>' +
                    '<td>' +
                        '<input type="text" name="tAmount[]" class="form-control" placeholder="Total Amount" value="">' +
                    '</td>' +
                    '<td>' +
                        '<a href="#" class="btn btn-danger remove"><i class="fas fa-minus"></i></a>' +
                    '</td>' +
                '</tr>';

            $('tbody').append(tr);
    };

    $('tbody').on('click','.remove', function(){
        $(this).parent().parent().remove();
    });
});
</script>

</html>

@endsection