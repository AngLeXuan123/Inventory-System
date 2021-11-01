@extends('layouts.app')



<main class="show" style="margin:50px 50px 50px 50px;">
    <h1>{{$user->name}}</h1>
    <p class="lead">{{ $user->email}}</p>
    <hr>

    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('user.index') }}"> Back</a>
    </div>
</main>
