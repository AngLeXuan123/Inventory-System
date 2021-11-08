@extends('layouts.app')

<html>

<body class="bg-primary">
    <main>
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
                                        <h3 class="text-center font-weight-bold my-4">Edit Order</h3>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" action="{{route('order.update',$order->id)}}">
                                            @csrf
                                            @method('PUT')
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
                                            <label for=""
                                                class="col-md-4 col-form-label text-md-right"><b>Customer Name</b></label>

                                            <input type="text" name="custName" class="form-control"
                                                value="{{$order->custName}}">

                                            <label for=""
                                                class="col-md-4 col-form-label text-md-right"><b>Address</b></label>

                                            <input type="text" name="address" class="form-control"
                                                value="{{$order->address}}">

                                            <label for=""
                                                class="col-md-4 col-form-label text-md-right"><b>Phone Number</b></label>

                                            <input type="text" name="phoneNum" class="form-control"
                                                value="{{$order->phoneNum}}">

                                            <label for=""
                                                class="col-md-4 col-form-label text-md-right"><b>Product Name</b></label>

                                            <input type="text" name="prodName" class="form-control"
                                                value="{{$order->prodName}}">

                                            <label for=""
                                                class="col-md-4 col-form-label text-md-right"><b>Quantity</b></label>

                                            <input type="text" name="quantity" class="form-control"
                                                value="{{$order->quantity}}">

                                            <label for=""
                                                class="col-md-4 col-form-label text-md-right"><b>Total Amount</b></label>

                                            <input type="text" name="tAmount" class="form-control"
                                                value="{{$order->tAmount}}">

                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button type="submit" class="btn btn-primary">
                                                    Update
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

</html>