<?php
//fetch.php
$connect = mysqli_connect();
$columns = array('Sname', 'city', 'zip');

$query = "SELECT * FROM supplier";

if(isset($_POST["search"]["value"]))
{
    $query .= ' WHERE Sname LIKE "'.$_POST["search"]["value"].'%" 
    ';
}

if(isset($_POST["order"]))
{
    $query .= ' ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
    ';
}
else
{
    $query .= ' ORDER BY Sname ASC';
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
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["Sname"].'" data-column="customerID">' . $row["Sname"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["Sname"].'" data-column="city">' . $row["city"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["Sname"].'" data-column="zip">' . $row["zip"] . '</div>';
    $sub_array[] = '<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["Sname"].'">Delete</button>';
    $data[] = $sub_array;
}

function get_all_data($connect)
{
    $query = "SELECT * FROM supplier;";
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