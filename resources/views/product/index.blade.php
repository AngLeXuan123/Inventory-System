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
        <h1 class="mt-4">Product List</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{route('adminHome')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Product</li>
        </ol>
        <p class="lead">All Product available.<a href="{{ route('product.create') }}">Add a new one?</a></p>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Product List
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Size</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Category</th>
                            <th>Brands</th>
                            <th>Operation</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Product Name</th>
                            <th>Size</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Category</th>
                            <th>Brands</th>
                            <th>Operation</th>
                        </tr>
                    </tfoot>

                    <tbody>
                        @foreach($prod as $prods)
                        <tr>
                            <td>{{$prods->prodName}}</td>
                            <td>{{$prods->size}}</td>
                            <td>RM{{$prods->price}}</td>
                            <td>{{$prods->quantity}}</td>
                            <td>{{$prods->Category}}</td>
                            <td>{{$prods->brands}}</td>
                            <td>
                                <form action="{{route('product.destroy', $prods->id)}}" method="POST">
                                    <a href="{{ route('product.edit', $prods->id) }}" class="btn btn-primary">Edit Product</a>
                                    <a href="{{ route('add.cart', $prods->id) }}" class="btn btn-success">Add To Cart</a>
                                    
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{('Total Product:')}} {{$prod -> count()}}
                {{$prod -> links()}}
            </div>
        </div>
    </div>
</main>
@endsection