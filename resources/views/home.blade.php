@extends('layouts.app')

@include('layouts.head')
@section('content')
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

<div class="container">
    <h3 class="h3">Items List </h3>
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <div class="row">
        @foreach($items as $item)

        <div class="col-md-3 col-sm-6">
            <div class="product-grid6">
                <div class="product-image6">
                    <a href="#">
                        <img class="pic-1" src="{{$item->item_image}}" style="height:250px;">
                    </a>
                </div>
                <div class="product-content">
                    <h3 class="title"><a href="#">{{$item->item_name}}</a></h3>
                    <div class="price">${{$item->item_amount}}
                    </div>
                </div>
                <ul class="social">
                    <li><button  data-tip="Add to Cart" class="add_cart" value="{{$item->id}}"><i class="fa fa-shopping-cart"></i></button></li>
                </ul>
            </div>
        </div>

        @endforeach
    </div>
</div>
<hr>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>



<script>
var id = $('.add_cart').val();

$('.add_cart').click(function(){
   $.ajax({
    type: 'POST',
    url: '{{url("add_cart")}}',
    data: {id : $(this).val() ,"_token": $('#token').val()},
    success:function(data) {
        if(data == 1)
        {
            alert('Only one item will be placed at once')
        }
    }


   })

});
</script>
@endsection
