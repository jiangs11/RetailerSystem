<html>
 <head>
  <title>Customer Information</title>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
  <style>
  body
  {
   margin:0;
   padding:0;
   background-color:#f1f1f1;
  }
  .box
  {
   width:1270px;
   padding:20px;
   background-color:#fff;
   border:1px solid #ccc;
   border-radius:5px;
   margin-top:25px;
   box-sizing:border-box;
  }
</style>
</head>
<body>
    <div class="container box">
        <h1 align="center">View, Add, Remove, Modify</h1>
        <h1 align="center">Customer Information</h1>
        <div class="table-responsive">
            <div align="right">
                <button type="button" name="add" id="add" class="btn btn-info" style="font-size:24px;">Add</button>
            </div>
            
            <div id="alert_message"></div>
            <table id="user_data" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th>Customer ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Address</th>
                <th>City</th>
                <th>State</th>
                <th>Zip Code</th>
                <th></th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</body>
</html>

<script type="text/javascript" language="javascript" >
 $(document).ready(function(){
  
  fetch_data();

  function fetch_data()
  {
    var dataTable = $('#user_data').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order" : [],
        "ajax" : {
            url :"fetch.php",
            type :"POST",
            //dataSrc : "",
            //dataType: "json"
            /*success:function(data, status) {
                alert("success"+data+":::"+status);
            },
            error:function(request, status, error) {
                alert("Error:"+JSON.stringify(request)+":::"+status+"::"+error);
            }*/
        }
    });
  }
 
  function update_data(id, column_name, value)
  {
   $.ajax({
    url:"update.php",
    method:"POST",
    data:{id:id, column_name:column_name, value:value},
    success:function(data)
    {
     $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
     $('#user_data').DataTable().destroy();
     fetch_data();
    }
   });
   setInterval(function(){
    $('#alert_message').html('');
   }, 5000);
  }

  $(document).on('blur', '.update', function(){
   var id = $(this).data("id");
   var column_name = $(this).data("column");
   var value = $(this).text();
   update_data(id, column_name, value);
  });
  
  $('#add').click(function(){
   var html = '<tr>';
   html += '<td contenteditable id="data1"></td>';
   html += '<td contenteditable id="data2"></td>';
   html += '<td contenteditable id="data3"></td>';
   html += '<td contenteditable id="data4"></td>';
   html += '<td contenteditable id="data5"></td>';
   html += '<td contenteditable id="data6"></td>';
   html += '<td contenteditable id="data7"></td>';
   html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
   html += '</tr>';
   $('#user_data tbody').prepend(html);
  });
  
  $(document).on('click', '#insert', function(){
   var customerID = $('#data1').text();
   var Fname = $('#data2').text();
   var Lname = $('#data3').text();
   var address = $('#data4').text();
   var city = $('#data5').text();
   var state = $('#data6').text();
   var zip = $('#data7').text();
   if(Fname != '' && Lname != '' && address != '' && city != '' && state != '' && zip != '')
   {
    $.ajax({
     url:"insert.php",
     method:"POST",
     data:{customerID:customerID, Fname:Fname, Lname:Lname, address:address, city:city, state:state, zip:zip},
     success:function(data)
     {
      $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
      $('#user_data').DataTable().destroy();
      fetch_data();
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 5000);
   }
   else
   {
    alert("All fields (except customer id) are required");
   }
  });
  
  $(document).on('click', '.delete', function(){
   var id = $(this).attr("id");
   if(confirm("Are you sure you want to remove this?"))
   {
    $.ajax({
     url:"delete.php",
     method:"POST",
     data:{id:id},
     success:function(data){
      $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
      $('#user_data').DataTable().destroy();
      fetch_data();
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 5000);
   }
  });
 });
</script>