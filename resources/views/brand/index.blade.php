@extends('layouts.app')
@section('content')

<title>Brand List</title>
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
        <h1 class="mt-4">Brand List</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Brands</li>
        </ol>
        <p class="lead">All Brand available.<a href="{{ route('brand.create') }}">Add a new one?</a></p>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Brand List
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Brand</th>
                            <th>Operation</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Brand</th>
                            <th>Operation</th>
                        </tr>
                    </tfoot>

                    <tbody>
                        @foreach($brand as $brands)
                        <tr>
                            <td>{{ $brands->brand}}</td>
                            <td>
                                <form action="{{route('brand.destroy', $brands->id)}}" method="POST">

                                @can('Brand-edit')
                                    <a href="{{ route('brand.edit', $brands->id) }}" class="btn btn-primary">Edit
                                        Brand</a>
                                @endcan

                                    @csrf
                                    @method('DELETE')
                                    
                                    @can('Brand-delete')
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