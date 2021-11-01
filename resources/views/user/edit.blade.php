@extends('layouts.app')

<html>
    <body class="bg-primary">
        <main class="show" style="margin:50px 50px 50px 50px;">
            
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

            <div id="layoutAuthentication">
                <div id="layoutAuthentication_content">
                    <main>
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-5">
                                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                                        <div class="card-header">
                                            <h3 class="text-center font-weight-bold my-4">Edit User</h3>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{route('user.update',$user->id)}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <label for="email"
                                                    class="col-md-4 col-form-label text-md-right"><b>Name</b></label>

                                                    <input type="text" name="name" class="form-control" value="{{$user->name}}">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <label for="password"
                                                    class="col-md-4 col-form-label text-md-right"><b>Email</b></label>
                                                    <input class="form-control" type="email" name="email" value="{{$user->email}}">

                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror

                                                <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                    <button type="submit" class="btn btn-primary">
                                                        Update
                                                    </button>
                                                    <a href="{{route('user.index')}}">Back to User List.</a>
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