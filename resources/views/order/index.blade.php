@extends('layouts.app')
@section('content')

<title>Order List</title>
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
        <h1 class="mt-4">Order List</h1>
        <ol class="breadcrumb mb-4">
            @can('Dashboard-list')
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Orders</li>
            @endcan
        </ol>
        <p class="lead">All Orders Made.
            @can('Order-create')
            <a href="{{ route('order.create') }}">Add a new one?</a>
            @endcan
        </p>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Order List
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Customer Email</th>
                            <th>Address</th>
                            <th>Phone Number</th>
                            <th>Total Item</th>
                            <th>Total Amount</th>
                            <th>Operation</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Customer Name</th>
                            <th>Customer Email</th>
                            <th>Address</th>
                            <th>Phone Number</th>
                            <th>Total Item</th>
                            <th>Total Amount</th>
                            <th>Operation</th>
                        </tr>
                    </tfoot>

                    <tbody>
                        @foreach($order as $orders)
                        <tr>
                            <td>{{$orders->custName}}</td>
                            <td>{{$orders->email}}</td>
                            <td>{{$orders->address}}</td>
                            <td>{{$orders->phoneNum}}</td>
                            <td>{{$orders->orderItems->count('product_id')}}</td>
                            <td>RM{{$orders->orderItems->sum('tAmount')}}</td>
                            <td>
                                <form action="{{route('order.destroy', $orders->id)}}" method="POST">
                                    @can('Order-edit')
                                    <a class="btn btn-primary" href="{{ route('order.edit', $orders->id) }}"><i
                                            class="fas fa-edit"></i></a>
                                    @endcan

                                    @csrf
                                    @method('DELETE')
                                    
                                    @can('Order-delete')
                                    <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                    @endcan

                                    <a class="btn btn-success" href="{{ url('generate-invoice',$orders->id) }}"><i
                                            class="fas fa-file-invoice"></i></a>
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