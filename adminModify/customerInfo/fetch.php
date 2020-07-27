<?php
//fetch.php
$connect = mysqli_connect( );
$columns = array('customerID', 'Fname', 'Lname', 'address', 'city', 'state', 'zip');

$query = "SELECT * FROM customer";

if(isset($_POST["search"]["value"]))
{
    $query .= ' WHERE Fname LIKE "'.$_POST["search"]["value"].'%" OR Lname LIKE "'.$_POST["search"]["value"].'%" 
    ';
}

if(isset($_POST["order"]))
{
    $query .= ' ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
    ';
}
else
{
    $query .= ' ORDER BY customerID ASC';
}

$query .= ';';
/*if($_POST["length"] != -1)
{
    $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}*/
$result = mysqli_query($connect, $query);
if (!$result) {
    printf("Error: %s\n", mysqli_error($connect));
    exit();
}
$number_filter_row = mysqli_num_rows($result);

$data = array();

while($row = mysqli_fetch_array($result))
{
    $sub_array = array();
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["customerID"].'" data-column="customerID">' . $row["customerID"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["customerID"].'" data-column="Fname">' . $row["Fname"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["customerID"].'" data-column="Lname">' . $row["Lname"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["customerID"].'" data-column="address">' . $row["address"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["customerID"].'" data-column="city">' . $row["city"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["customerID"].'" data-column="state">' . $row["state"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["customerID"].'" data-column="zip">' . $row["zip"] . '</div>';
    $sub_array[] = '<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["customerID"].'">Delete</button>';
    $data[] = $sub_array;
}

function get_all_data($connect)
{
    $query = "SELECT * FROM customer;";
    $result = mysqli_query($connect, $query);
    return mysqli_num_rows($result);
}

$output = array(
    "draw"    => intval($_POST["draw"]),
    "recordsTotal"  =>  strval(get_all_data($connect)),
    "recordsFiltered" => $number_filter_row,
    "data"    => $data
);

echo json_encode($output);

?>