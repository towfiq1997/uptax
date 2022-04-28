<?php

$con = mysqli_connect('localhost', 'shebabar_chamber', 'chamberchoyon', 'shebabar_chamber');

$request = $_REQUEST;
$col = array(
    0   =>  'refno',
    1   =>  'comname',
    2   =>  'memberno',
    3   =>  'crno'
);  //create column like table in database

$sql = "SELECT * FROM letter";
$query = mysqli_query($con, $sql);

$totalData = mysqli_num_rows($query);

$totalFilter = $totalData;

//Search
$sql = "SELECT * FROM letter WHERE 1=1";
if (!empty($request['search']['value'])) {
    $sql .= " AND (refno Like '" . $request['search']['value'] . "%' ";
    $sql .= " OR comname Like '" . $request['search']['value'] . "%' ";
    $sql .= " OR memberno Like '" . $request['search']['value'] . "%' ";
    $sql .= " OR crno Like '" . $request['search']['value'] . "%' )";
}
$query = mysqli_query($con, $sql);
$totalData = mysqli_num_rows($query);

//Order
$sql .= " ORDER BY " . $col[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'] . "  LIMIT " .
    $request['start'] . "  ," . $request['length'] . "  ";

$query = mysqli_query($con, $sql);

$data = array();

while ($row = mysqli_fetch_assoc($query)) {
    $subdata = array();
    $subdata[] = $row['refno'];
    $subdata[] = $row['comname'];
    $subdata[] = $row['contact'];
    $subdata[] = $row['memberno'];
    $subdata[] = $row['crno'];
    $subdata[] = $row['date'];
    $subdata[] = $row['valid_till'];
    $link = "letter/" . $row['refno'];
    $subdata[] = '<a href="letter/' . $row["refno"] . '.pdf"><i class="fas fa-download"></i></a>';
    $data[] = $subdata;
}

$json_data = array(
    "draw"              =>  intval($request['draw']),
    "recordsTotal"      =>  intval($totalData),
    "recordsFiltered"   =>  intval($totalFilter),
    "data"              =>  $data
);

echo json_encode($json_data);
