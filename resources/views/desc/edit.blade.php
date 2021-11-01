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
                                            <h3 class="text-center font-weight-bold my-4">Edit Description</h3>
                                        </div>
                                        <div class="card-body">
                                            <form method="post" action="{{route('desc.update',$descs->id)}}">
                                                @csrf
                                                @method('PUT')
                                                <label for="email"
                                                    class="col-md-4 col-form-label text-md-right"><b>Title</b></label>

                                                <input type="text" name="title" class="form-control"
                                                    value="{{$descs->title}}">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <label for="password"
                                                    class="col-md-4 col-form-label text-md-right"><b>Description</b></label>
                                                <textarea class="form-control" style="height:150px" name="desc"
                                                    value="Description">{{$descs->desc}}</textarea>

                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror

                                                <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                    <button type="submit" class="btn btn-primary">
                                                        Update
                                                    </button>
                                                    <a href="{{route('desc.index')}}">Back to Description List.</a>
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