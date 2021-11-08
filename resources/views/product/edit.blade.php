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
                                        <h3 class="text-center font-weight-bold my-4">Edit Product</h3>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" action="{{route('product.update',$prod->id)}}">
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
                                                class="col-md-4 col-form-label text-md-right"><b>Product Name</b></label>

                                            <input type="text" name="prodName" class="form-control"
                                                value="{{$prod->prodName}}">

                                            <label for=""
                                                class="col-md-4 col-form-label text-md-right"><b>Size</b></label>

                                            <input type="text" name="size" class="form-control"
                                                value="{{$prod->size}}">

                                            <label for=""
                                                class="col-md-4 col-form-label text-md-right"><b>Price</b></label>

                                            <input type="text" name="price" class="form-control"
                                                value="{{$prod->price}}">

                                            <label for=""
                                                class="col-md-4 col-form-label text-md-right"><b>Quantity</b></label>

                                            <input type="text" name="quantity" class="form-control"
                                                value="{{$prod->quantity}}">

                                            <label for=""
                                                class="col-md-4 col-form-label text-md-right"><b>Category</b></label>

                                            <input type="text" name="Category" class="form-control"
                                                value="{{$prod->Category}}">

                                            <label for=""
                                                class="col-md-4 col-form-label text-md-right"><b>Brands</b></label>

                                            <input type="text" name="brands" class="form-control"
                                                value="{{$prod->brands}}">

                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button type="submit" class="btn btn-primary">
                                                    Update
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