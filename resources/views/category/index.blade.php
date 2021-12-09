@extends('layouts.app')
@section('content')

<title>Category List</title>
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
        <h1 class="mt-4">Category List</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Categories</li>
        </ol>
        <p class="lead">All Category available.<a href="{{ route('category.create') }}">Add a new one?</a>
        </p>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Category List
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Operation</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Category</th>
                            <th>Operation</th>
                        </tr>
                    </tfoot>

                    <tbody>
                        @foreach($cat as $cats)
                        <tr>
                            <td>{{$cats->Category}}</td>
                            <td>
                                <form action="{{route('category.destroy', $cats->id)}}" method="POST">

                                    @can('Category-edit')
                                    <a href="{{ route('category.edit', $cats->id) }}" class="btn btn-primary">Edit
                                        Category</a>
                                    @endcan

                                    @csrf
                                    @method('DELETE')

                                    @can('Category-delete')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                    @endcan

                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection