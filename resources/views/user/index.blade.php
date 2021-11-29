
@extends('layouts.app')


@section('content')
<main>
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
            <li class="breadcrumb-item"><a href="{{route('adminHome')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Users</li>
        </ol>
        <p class="lead">All Users.</p>

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
                            <th>Role</th>
                            <th>Operation</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Operation</th>
                        </tr>
                    </tfoot>

                    <tbody>
                        @foreach($user as $users)
                        <tr>
                            <td>{{ $users->name}}</td>
                            <td>{{ $users->email}}</td>
                            <td>{{ $users->userType}}</td>
                            <td>
                                <form action="{{route('user.destroy', $users->id)}}" method="POST">
                                    <a href="{{ route('user.show', $users->id) }}" class="btn btn-info">View
                                        Task</a>
                                    <a href="{{ route('user.edit', $users->id) }}" class="btn btn-primary">Edit Task</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{('Total Description:')}} {{$user -> count()}}
                {{$user -> links()}}
            </div>
        </div>
    </div>
</main>

@endsection