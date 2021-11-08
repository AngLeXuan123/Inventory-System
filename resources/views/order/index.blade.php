@extends('layouts.app')
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
            <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Orders</li>
        </ol>
        <p class="lead">All Orders Made.<a href="{{ route('order.create') }}">Add a new one?</a></p>

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
                            <th>Address</th>
                            <th>Phone Number</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Total Amount</th>
                            <th>Operation</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Customer Name</th>
                            <th>Address</th>
                            <th>Phone Number</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Total Amount</th>
                            <th>Operation</th>
                        </tr>
                    </tfoot>

                    <tbody>
                        @foreach($order as $orders)
                        <tr>
                            <td>{{$orders->custName}}</td>
                            <td>{{$orders->address}}</td>
                            <td>{{$orders->phoneNum}}</td>
                            <td>{{$orders->prodName}}</td>
                            <td>{{$orders->quantity}}</td>
                            <td>{{$orders->tAmount}}</td>
                            <td>
                                <form action="{{route('order.destroy', $orders->id)}}" method="POST">
                                    <a href="{{ route('order.edit', $orders->id) }}" class="btn btn-primary">Edit
                                        Task</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{('Total Orders:')}} {{$order -> count()}}
                {{$order -> links()}}
            </div>
        </div>
    </div>
</main>