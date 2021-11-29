@extends('layouts.app')
@section('content')

<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-bold my-4">Edit Brand</h3>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('brand.update',$brand->id)}}">
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
                            <label for="" class="col-md-4 col-form-label text-md-right"><b>brand</b></label>

                            <input type="text" name="brand" class="form-control" value="{{$brand->brand}}">

                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                                <a href="{{route('brand.index')}}">Back to Brand List.</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection