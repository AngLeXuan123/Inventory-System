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
                                            
                                            <label for=""
                                                class="col-md-4 col-form-label text-md-right"><b>Customer Name</b></label>

                                            <input type="text" name="custName" class="form-control" placeholder="Full Name">

                                            <label for=""
                                                class="col-md-4 col-form-label text-md-right"><b>Address</b></label>

                                            <input type="text" name="address" class="form-control" placeholder="Address">

                                            <label for=""
                                                class="col-md-4 col-form-label text-md-right"><b>Phone Number</b></label>

                                            <input type="text" name="phoneNum" class="form-control" placeholder="Phone Number">

                                            <label for=""
                                                class="col-md-4 col-form-label text-md-right"><b>Product Name</b></label>

                                            <select name="prodName" class="form-control">
                                                @foreach($prods as $prod)
                                                    <option value="{{$prod['prodName']}}">{{$prod['prodName']}}</option>
                                                @endforeach
                                            </select>

                                            <label for=""
                                                class="col-md-4 col-form-label text-md-right"><b>Quantity</b></label>

                                            <input type="text" name="quantity" class="form-control" placeholder="Quantity">

                                            <label for=""
                                                class="col-md-4 col-form-label text-md-right"><b>Total Amount</b></label>

                                            <input type="text" name="tAmount" class="form-control" placeholder="Total Amount" value="" readonly>
 
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

</html>

<script>
    
</script>