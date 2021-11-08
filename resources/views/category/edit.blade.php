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
                                        <h3 class="text-center font-weight-bold my-4">Edit Category</h3>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" action="{{route('category.update',$cat->id)}}">
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
                                                class="col-md-4 col-form-label text-md-right"><b>Category</b></label>

                                            <input type="text" name="Category" class="form-control"
                                                value="{{$cat->Category}}">

                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button type="submit" class="btn btn-primary">
                                                    Update
                                                </button>
                                                <a href="{{route('category.index')}}">Back to Category List.</a>
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