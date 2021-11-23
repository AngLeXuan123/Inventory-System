<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body{
            background-color: #F6F6F6; 
            margin: 0;
            padding: 0;
        }
        h1,h2,h3,h4,h5,h6{
            margin: 0;
            padding: 0;
        }
        p{
            margin: 0;
            padding: 0;
        }
        .container{
            width: 80%;
            margin-right: auto;
            margin-left: auto;
            margin-top:80px;
        }
        .brand-section{
           background-color: #0d1033;
           padding: 39px 60px;
        }
        .logo{
            width: 50%;
        }

        .row{
            display: flex;
            flex-wrap: wrap;
        }
        .col-6{
            width: 50%;
            flex: 0 0 auto;
        }
        .text-white{
            color: #fff;
            font-size:small;
        }
        .text-white-title{
            color: #fff;
            font-size:20px;
        }
 
        .body-section{
            padding: 16px;
            border: 1px solid gray;
        }
        .heading{
            font-size: 20px;
            margin-bottom: 08px;
        }
        .sub-heading{
            color: #262626;
            margin-bottom: 05px;
        }
        table{
            background-color: #fff;
            width: 100%;
            border-collapse: collapse;
        }
        table thead tr{
            border: 1px solid #111;
            background-color: #f2f2f2;
        }
        table td {
            vertical-align: middle !important;
            text-align: center;
        }
        table th, table td {
            padding-top: 08px;
            padding-bottom: 08px;
        }
        .table-bordered{
            box-shadow: 0px 0px 5px 0.5px gray;
        }
        .table-bordered td, .table-bordered th {
            border: 1px solid #dee2e6;
        }
        .text-right{
            text-align: end;
        }
        .w-20{
            width: 20%;
        }
        .float-right{
            float: right;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="brand-section">
            <div class="row">
                <div class="">
                    <h1 class="text-white-title">SB ENGINEERING</h1>
                </div>
                <div class="">
                    <div style="float:right;">
                        <p class="text-white">lot 1, 1st floor, Paramount Ind.Development,</p>
                        <p class="text-white">mile 5.5, Jalan Kolombong,</p>
                        <p class="text-white">88450 K.K, Sabah.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="body-section">
            <div class="">
                <div class="">
                    <h2 class="heading">Invoice No: {{$order->invoice_id}}</h2>
                    <p class="sub-heading">Order Date: {{$order->created_at->format('d-m-y')}}</p>
                </div>
                <div class="">
                    <p class="sub-heading">Full Name: {{$order->custName}} </p>
                    <p class="sub-heading">Email: {{$order->email}} </p>
                    <p class="sub-heading">Address: {{$order->address}}</p>
                    <p class="sub-heading">Phone Number: {{$order->phoneNum}} </p>
                </div>
            </div>
        </div>

        <div class="body-section">
            <h3 class="heading">Ordered Items</h3>
            <br>
            <table class="table-bordered">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th class="w-20">Price(RM)</th>
                        <th class="w-20">Quantity</th>
                        <th class="w-20">Total Amount(RM)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orderItems as $value)
                    <tr>
                        <td>{{$value->product->prodName}}</td>
                        <td>{{$value->product->price}}</td>
                        <td>{{$value->order_quantity}}</td>
                        <td>{{$value->tAmount}}</td>
                    </tr>
                    <?php $gTotal += $value->tAmount ?>
                    @endforeach
                    <tr>
                        <td colspan="3" class="text-left">Grand Total(RM)</td>
                        <td>{{$gTotal}}</td>
                    </tr>
                    
                </tbody>
            </table>
            <br>
        </div>

        <div class="body-section">
            <p>&copy; Copyright 2021 - SB ENGINEERING. All rights reserved. 
               
            </p>
        </div>      
    </div>      

</body>
</html>