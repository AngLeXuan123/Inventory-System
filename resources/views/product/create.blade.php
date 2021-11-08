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
                                        <h3 class="text-center font-weight-bold my-4">Add a New Product</h3>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('product.store') }}" method="POST">
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
                                            
                                            <label class="col-md-4 col-form-label text-md-right"><b>Product Name</b></label>

                                            <input type="text" name="prodName" class="form-control" placeholder="Name">

                                            <label class="col-md-4 col-form-label text-md-right"><b>Size</b></label>

                                            <input type="text" name="size" class="form-control" placeholder="Size">

                                            <label class="col-md-4 col-form-label text-md-right"><b>Price</b></label>

                                            <input type="text" name="price" class="form-control" placeholder="Price">

                                            <label class="col-md-4 col-form-label text-md-right"><b>Quantity</b></label>

                                            <input type="text" name="quantity" class="form-control" placeholder="Quantity">

                                            <label class="col-md-4 col-form-label text-md-right"><b>Category</b></label>

                                            <select name="Category" class="form-control">
                                                @foreach($cat as $cats)
                                                <option value="{{$cats}}">{{$cats}}</option>
                                                @endforeach
                                            </select>

                                            <label class="col-md-4 col-form-label text-md-right"><b>Brands</b></label>

                                            <select name="brands" class="form-control">
                                                @foreach($brand as $brands)
                                                <option value="{{$brands}}">{{$brands}}</option>
                                                @endforeach
                                            </select>

                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button type="submit" class="btn btn-primary">
                                                    Submit
                                                </button>
                                                <a href="{{route('product.index')}}">Back to Product List.</a>
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