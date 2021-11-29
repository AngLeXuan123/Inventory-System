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
        <h1 class="mt-4">Description List</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('adminHome')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Descriptions</li>
        </ol>
        <p class="lead">All your description.<a href="{{ route('desc.create') }}">Add a new one?</a></p>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Description List
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Operation</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Operation</th>
                        </tr>
                    </tfoot>

                    <tbody>
                        @foreach($descs as $desc1)
                        <tr>
                            <td>{{ $desc1->title}}</td>
                            <td>{{ $desc1->desc}}</td>
                            <td>
                                <form action="{{route('desc.destroy', $desc1->id)}}" method="POST">
                                    <a href="{{ route('desc.show', $desc1->id) }}" class="btn btn-info">View
                                        Task</a>
                                    <a href="{{ route('desc.edit', $desc1->id) }}" class="btn btn-primary">Edit Task</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{('Total Description:')}} {{$descs -> count()}}
                {{$descs -> links()}}
            </div>
        </div>
    </div>
</main>

@endsection