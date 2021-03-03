
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
  <h2>Add Items</h2>
  <!-- <form class="form-horizontal" action="{{route('add_item')}}" method="POST"> -->
  {!! Form::open(['url' => 'admin/edit_item/'.$item->id, 'class' => 'form-horizontal','files' => true]) !!}
  @csrf <!-- {{ csrf_field() }} -->
    <div class="form-group">
      <label class="control-label col-sm-2">Item:</label>
      <div class="col-sm-10">
        <!-- <input type="email" class="form-control" id="email" placeholder="Enter email" name="email"> -->

        {!! Form::text('item_name', $item->item_name, ['class' => 'form-control', 'id' => 'input_item_name', 'placeholder' => 'ItemName']) !!}
                    <span class="text-danger">{{ $errors->first('item_name') }}</span>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Description:</label>
      <div class="col-sm-10">
        <!-- <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd"> -->
        {!! Form::text('item_description', $item->item_description, ['class' => 'form-control', 'id' => 'input_item_description', 'placeholder' => 'ItemDescription']) !!}
                    <span class="text-danger">{{ $errors->first('item_description') }}</span>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Amount:</label>
      <div class="col-sm-10">
        <!-- <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd"> -->
        {!! Form::text('item_amount', $item->item_amount, ['class' => 'form-control', 'id' => 'input_item_amount', 'placeholder' => 'Amount']) !!}
                    <span class="text-danger">{{ $errors->first('item_amount') }}</span>
      </div>
    </div>


    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Image:</label>
      <div class="col-sm-10">
        <!-- <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd"> -->
        {!! Form::file('item_image', ['class' => 'form-control', 'id' => 'item_image', 'accept' => 'image/*']) !!}
                    <span class="text-danger">{{ $errors->first('item_image') }}</span>
            @if($item->item_image)
            <img src="{{$item->item_image}}" class="css-class" alt="alt text" style="width:100px">
            @endif
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Status:</label>
      <div class="col-sm-10">
        <!-- <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd"> -->
        {!! Form::select('status', array('Active' => 'Active', 'Inactive' => 'Inactive'), $item->status, ['class' => 'form-control', 'id' => 'input_status', 'placeholder' => 'Select']) !!}
                    <span class="text-danger">{{ $errors->first('status') }}</span>
      </div>
    </div>


    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <input type="submit" class="btn btn-primary" value="Submit">
      </div>
    </div>
  </form>
</div>

</body>
</html>

</div>
@include('admin.layouts.foot')
