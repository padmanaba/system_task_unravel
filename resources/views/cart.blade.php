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
                    <div class="panel-heading">
                        <h3>
                            <img class="img-circle img-thumbnail" src="https://bootdey.com/img/Content/user_3.jpg">
                            {{Auth::user()->name}}
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Product Name</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>

                                @foreach($cart as $cart)
                                <tr>
                                <td><img src="{{$cart->item->item_image}}" class="img-cart"></td>
                                    <td><strong>{{$cart->item->item_name}}</strong><p></p></td>
                                    <td>
                                    <form class="form-inline">
                                        <input class="form-control" type="text" value="{{$cart->item_count}}" readonly>
                                    </form>
                                    </td>
                                    @php
                                    $total = $cart->item->item_amount * $cart->item_count;
                                    @endphp
                                    <td>${{$total}}</td>
                                    <td>${{$total}}</td>
                                    <input type="hidden" name="total_amount" value="{{$total}}">
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="6">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-right">Total Product</td>
                                    <td>${{$total}}</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-right">Total Shipping</td>
                                    <td>$2.00</td>
                                    @php
                                    $shipping = 2;
                                    @endphp
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-right"><strong>Total</strong></td>
                                    <td>${{$total + $shipping }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
                <input type="submit" class="btn btn-primary pull-right" value="Place Order">
            </div>
        </div>
    </div>
</div>
</form>
@endsection
