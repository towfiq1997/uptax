<?php
session_start();
$con = mysqli_connect('localhost', 'root', '', 'survey_db');

$params = $columns = $totalRecords = $data = array();
 
 $params = $_REQUEST;
 
 $columns = array(
 0 => 'id',
 1 => 'owner_name', 
 2 => 'nid',
 3 => 'ward_no',
 4 => 'holding_no',
 );
 
 $where_condition = $sqlTot = $sqlRec = "";
 
 if( !empty($params['search']['value']) ) {
 $where_condition .= " WHERE ";
 $where_condition .= " ( nid LIKE '%".$params['search']['value']."%' ";    
//  $where_condition .= " OR ward_no LIKE '%".$params['search']['value']."%' ";    
//  $where_condition .= " OR ward_no LIKE '%".$params['search']['value']."%' ";    
 $where_condition .= " OR holding_no LIKE '%".$params['search']['value']."%' ";    
 $where_condition .= " OR id LIKE '%".$params['search']['value']."%' )";
 }
 $uni_code = $_SESSION['u_code'];
 $sql_query = " SELECT * FROM assesment_input ";
 $sqlTot .= $sql_query;
 $sqlRec .= $sql_query;
 
 if(isset($where_condition) && $where_condition != '') {
 
 $sqlTot .= $where_condition;
 $sqlRec .= $where_condition;
 }
 
 $sqlRec .=  " ORDER BY ". $columns[$params['order'][0]['column']]."   ".$params['order'][0]['dir']."  LIMIT ".$params['start']." ,".$params['length']." ";
 
 $queryTot = mysqli_query($con, $sqlTot) or die("Database Error:". mysqli_error($con));
 
 $totalRecords = mysqli_num_rows($queryTot);
 
 $queryRecords = mysqli_query($con, $sqlRec) or die("Error to Get the Post details.");
 $data = array();
 while( $row = mysqli_fetch_assoc($queryRecords) ) { 
    $subdata = array();
    $image_p = $row['profile_pic'];
    $subdata[] = '<img src="uploads/'.$image_p.'" style="border-radius:50%"  width="80" height="80">';
    $subdata[] = $row['id'];
    $subdata[] = $row['owner_name'];  
    $subdata[] = $row['father_name'];
    $subdata[] = $row['nid'];
    $subdata[] = $row['ward_no'];
    $subdata[] = $row['holding_no'];
    $subdata[] = $row['previous_due'];
    $subdata[] = '<a href="view_single.php?id=' . $row["id"] . '" style="margin-right:10px !important; text-decoration:none">ভিউ</a><a style="text-decoration:none" href="edit_single.php?id=' . $row["id"] . '">এডিট</a>';
    $data[] = $subdata;
 } 
 
 $json_data = array(
 "draw"            => intval( $params['draw'] ),   
 "recordsTotal"    => intval( $totalRecords ),  
 "recordsFiltered" => intval($totalRecords),
 "data"            => $data
 );
 
 echo json_encode($json_data);
?>