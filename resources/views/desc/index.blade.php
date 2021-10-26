@extends('layouts.app')

@section('content')

<main class="show" style="margin:50px 50px 50px 50px;">
    <h1>Description List</h1>
    <p class="lead">All your tasks. <a href="{{ route('desc.create') }}">Add a new one?</a></p>
    <hr>

    @if(Session::has('flash_message'))
    <div class="alert alert-success">
        {{ Session::get('flash_message') }}
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
    </div>
    @endif

    @foreach($desc as $descs)
    <h3>{{ $descs->title }}</h3>
    <p>{{ $descs->desc}}</p>
    <form action="{{route('desc.destroy', $descs->id)}}" method="POST">
        <a href="{{ route('desc.show', $descs->id) }}" class="btn btn-info">View Task</a>
        <a href="{{ route('desc.edit', $descs->id) }}" class="btn btn-primary">Edit Task</a>
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    <hr>
    @endforeach
    {{ $desc->links()}}
</main>

@endsection