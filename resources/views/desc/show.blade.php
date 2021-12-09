@extends('layouts.app')
@section('content')

<title>Show Description</title>
<main class="show" style="margin:50px 50px 50px 50px;">
    <h1>{{$descs->title}}</h1>
    <p class="lead">{{ $descs->desc }}</p>
    <hr>

    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('desc.index') }}"> Back</a>
    </div>
</main>
@endsection