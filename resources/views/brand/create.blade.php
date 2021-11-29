@extends('layouts.app')

@section('content')

<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-bold my-4">Add a New Brand</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('brand.store') }}" method="POST">
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

                            <label for="" class="col-md-4 col-form-label text-md-right"><b>Brand
                                    Name</b></label>

                            <input type="text" name="brand" class="form-control" placeholder="Brand">

                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                <button type="submit" class="btn btn-primary">
                                    Submit
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