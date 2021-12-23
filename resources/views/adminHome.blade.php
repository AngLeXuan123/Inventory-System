@extends('layouts.app')

@section('content')
<title>
    Admin Dashboard
</title>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Description List</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{route('desc.index')}}">View
                            Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Users List</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{url('users')}}">View
                            Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            @can('role-list')
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Manage Roles</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{route('roles.index')}}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            @endcan
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Danger Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Users Registered Monthly Report Area Graph
                    </div>
                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="50"></canvas></div>
                    <div class="card-footer small text-muted">({{$month}}, {{$time}})</div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-line"></i>
                        Top Sales of Products
                    </div>
                    <div class="card-body"><canvas id="bar-chart-horizontal" width="100%" height="50"></canvas></div>
                    <div class="card-footer small text-muted">({{$month}}, {{$time}})</div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Total Stock of Product Report Bar Graph
                    </div>
                    <div class="card-body"><canvas id="myBarChart" width="100%" height="50"></canvas></div>
                    <div class="card-footer small text-muted">({{$month}}, {{$time}})</div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-pie me-1"></i>
                        Total Orders Monthly Report Pie Chart
                    </div>
                    <div class="card-body"><canvas id="myPieChart" width="100%" height="50"></canvas></div>
                    <div class="card-footer small text-muted">({{$month}}, {{$time}})</div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4"></script>

<!-- Bar-graph -->
<script>
var product_data_name = JSON.parse('{!! json_encode($product_name) !!}');
var product_data_qty = JSON.parse('{!! json_encode($product_qty) !!}');
var color = JSON.parse('{!! json_encode($product_color) !!}');
var ctx = document.getElementById("myBarChart");
var myLineChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: product_data_name,
        datasets: [{
            label: "Quantity",
            backgroundColor: color,
            borderColor: color,
            data: product_data_qty,
        }],
    },
    options: {
        scales: {
            xAxes: [{
                time: {
                    unit: 'month'
                },
                gridLines: {
                    display: false
                },
                ticks: {
                    maxTicksLimit: 6
                },
                stacked: true
            }],
            yAxes: [{
                ticks: {
                    min: 0,
                    max: 300,
                    maxTicksLimit: 8
                },
                gridLines: {
                    display: true
                },
                stacked: true
            }],
        },
        legend: {
            display: false
        }
    }
});
</script>

<!-- Area-graph -->
<script>
var user_Xaxis_data = JSON.parse('{!! json_encode($months) !!}');
var user_Yaxis_data = JSON.parse('{!! json_encode($numberOfUsers) !!}');
</script>

<!-- Vertical Bar-graph -->
<script>
var sales_name = JSON.parse('{!! json_encode($product_sales_name) !!}');
var total_sales = JSON.parse('{!! json_encode($product_sales) !!}');
var color = JSON.parse('{!! json_encode($product_sales_color) !!}');
new Chart(document.getElementById("bar-chart-horizontal"), {
    type: 'horizontalBar',
    data: {
        labels: sales_name,
        datasets: [{
            label: "Total Sales",
            backgroundColor: color,
            data: total_sales
        }]
    },
    options: {
        scales: {
            xAxes: [{
                time: {
                    unit: 'month'
                },
                gridLines: {
                    display: false
                },
                ticks: {
                    min: 0,
                    max: 50,
                    maxTicksLimit: 8
                },
                gridLines: {
                    display: true
                },
            }],
        },
        legend: {
            display: false
        },
        title: {
            display: true,
            text: 'Top Sales of Product'
        }
    }
});
</script>

<!-- Pie-chart -->
<script>
var orderMonth = JSON.parse('{!! json_encode($order_month) !!}');
var totalOrder = JSON.parse('{!! json_encode($order_report) !!}');
var color = JSON.parse('{!! json_encode($order_color) !!}');
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: orderMonth,
        datasets: [{
            data: totalOrder,
            backgroundColor: color,
        }],
    },
});
</script>
@endsection