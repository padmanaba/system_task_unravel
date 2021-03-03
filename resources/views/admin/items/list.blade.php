
@include('admin.layouts.sidebar')

<div class="main">

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add Items</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>View Items</h2>
  <!-- <form class="form-horizontal" action="{{route('add_item')}}" method="POST"> -->
  {!! Form::open(['url' => 'admin/add_item', 'class' => 'form-horizontal','files' => true]) !!}
  @csrf <!-- {{ csrf_field() }} -->
    <div class="form-group">
      <label class="control-label col-sm-2">Item:</label>
      <div class="col-sm-10">
        <!-- <input type="email" class="form-control" id="email" placeholder="Enter email" name="email"> -->
        {{$item->item_name}}

      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Description:</label>
      <div class="col-sm-10">
        <!-- <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd"> -->
       {{$item->item_description}}
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Amount:</label>
      <div class="col-sm-10">
        <!-- <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd"> -->
        {{$item->item_amount}}
      </div>
    </div>


    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Image:</label>
      <div class="col-sm-10">
        <!-- <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd"> -->
        <img src="{{$item->item_image}}" class="css-class" alt="alt text" style="width:100px">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Status:</label>
      <div class="col-sm-10">
        <!-- <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd"> -->
        {{$item->status}}
      </div>
    </div>

  </form>
</div>

</body>
</html>

</div>
@include('admin.layouts.foot')
