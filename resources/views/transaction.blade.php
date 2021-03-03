@extends('layouts.app')

@section('content')
<style>
.img-cart {
    display: block;
    max-width: 50px;
    height: auto;
    margin-left: auto;
    margin-right: auto;
}
table tr td{
    border:1px solid #FFFFFF;
}

table tr th {
    background:#eee;
}

.panel-shadow {
    box-shadow: rgba(0, 0, 0, 0.3) 7px 7px 7px;
}</style>
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
<form method="POST" action="{{url('place_order')}}">
@csrf
<div class="container bootstrap snippets bootdey">
    <div class="col-md-9 col-sm-8 content">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                  <li><a href="{{url('home')}}">Home</a></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-info panel-shadow">
                    <div class="panel-body">
                        <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>item</th>
                                <th>Transaction Id</th>
                                <th>Item Name</th>
                                <th>Total Amount</th>
                                <th>Payment Method</th>
                            </tr>
                            </thead>
                            <tbody>

                                @foreach($transasction as $transasction)
                                <tr>
                                <td><strong>{{$transasction->id}}</strong></td>
                                <td><img src="{{$transasction->item->item_image}}" class="img-cart"></td>
                                <td><strong>{{$transasction->item->item_name}}</strong></td>
                                <td><strong>{{$transasction->transaction_id}}</strong></td>
                                <td><strong>{{$transasction->total_amount}}</strong></td>
                                <td><strong>{{$transasction->payment_method}}</strong></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection
