@include('admin.layouts.head')
<!DOCTYPE html>
<html>
<head>
    <title>Transaction List</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> -->
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
@include('admin.layouts.sidebar')
<div class="main">
    <div class="container">
        <h1>Transaction Management</h1>
        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th> UserName</th>
                    <th>Itemname</th>
                    <th>Total Amount</th>
                    <th>PaymentMethod</th>
                    <th width="100px">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

</body>

<script type="text/javascript">


$('#edit_item').click(function(){
    alert('test');
  });
  $(function () {

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('transactions') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'user.name', name: 'name'},
            {data: 'item.item_name', name: 'itemname'},
            {data: 'total_amount', name: 'total_amount'},
            {data: 'payment_method', name: 'payment_method'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

  });

</script>
</html>
