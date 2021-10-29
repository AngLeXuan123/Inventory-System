@extends('layouts.app')



<main class="show" style="margin:50px 50px 50px 50px;">
    <h1>Edit Description</h1>
    <p class="lead"><a href="{{route('desc.index')}}">Back to Description List.</a></p>

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

    <form action="{{route('desc.update',$descs->id)}}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Title:</strong>
                    <input type="text" name="title" class="form-control" value="{{$descs->title}}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    <textarea class="form-control" style="height:150px" name="desc"
                        value="Description">{{$descs->desc}}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>

    </form>
</main>

