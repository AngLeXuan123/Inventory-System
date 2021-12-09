@extends('layouts.app')

@section('content')

<title>Create New Category</title>
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-bold my-4">Add a New Category</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('category.store') }}" method="POST">
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

                            <label for="" class="col-md-4 col-form-label text-md-right"><b>Category Name</b></label>

                            <input type="text" name="Category" class="form-control" placeholder="Category">

                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                <button type="submit" class="btn btn-primary">
                                    Submit
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

@endsection