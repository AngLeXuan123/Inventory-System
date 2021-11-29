
@extends('layouts.app')

@section('content')
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-bold my-4">Edit User</h3>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('user.update',$user->id)}}">
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
                            <label for="" class="col-md-4 col-form-label text-md-right"><b>Name</b></label>

                            <input type="text" name="name" class="form-control" value="{{$user->name}}">

                            <label for="" class="col-md-4 col-form-label text-md-right"><b>Email</b></label>

                            <input type="text" name="email" class="form-control" value="{{$user->email}}">

                            <label for="" class="col-md-4 col-form-label text-md-right"><b>Role</b></label>

                            <input type="text" name="userType" class="form-control" value="{{$user->userType}}">

                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                                <a href="{{route('user.index')}}">Back to Description List.</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection