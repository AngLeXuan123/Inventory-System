@extends('layouts.app')


<main class="show" style="margin:50px 50px 50px 50px;">
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

    <div class="container-fluid px-4">
        <h1 class="mt-4">User List</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Users</li>
        </ol>
        <p class="lead">All users.</p>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                User List
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Operation</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Operation</th>
                        </tr>
                    </tfoot>


                    <tbody>
                        @foreach($user as $users)
                        <tr>
                            <td>{{ $users->name }}</td>
                            <td>{{ $users->email}}</td>
                            <td>
                                <form method="POST">
                                    <a href="{{route('user.show', $users->id)}}" class="btn btn-info">View User</a>
                                    <a href="{{route('user.edit', $users->id)}}" class="btn btn-primary">Edit User</a>
                                    @csrf
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{('Total User:')}} {{$users -> count()}}
                {{$user -> links()}}
            </div>
        </div>
    </div>
</main>