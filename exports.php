<?php 
session_start();
include_once("inc/Functions.php");
$username = isset($_SESSION['email']) ? $_SESSION['email'] : NULL;
if ($username == NULL) {
    header('location:index.php');
}
$union_code = $_SESSION['code'];
$exports = new Survey();

$sql = "SELECT * FROM assesment_input WHERE union_code='$union_code'";
$result = $exports->con->query($sql);

$html ='<table><tr><td>id</td><td>ward_no</td><td>holding_no</td><td>owner_name</td><td>father_name</td><td>mother_name</td><td>occupation</td><td>type_of_house</td><td>total_land</td><td>source_of_income</td><td>nid</td><td>proverty_line</td><td>price_of_house</td><td>mobile_no</td><td>imopsed_tax</td><td>previous_due</td><td>fiscal_year</td><td>profile_pic</td><td>nid_photo</td><td>union_code</td><td>date</td></tr>';


while($row = $result->fetch_assoc()){
    $html .= '<tr><td>'.$row['id'].'</td><td>'.$row['ward_no'].'</td><td>'.$row['holding_no'].'</td><td>'.$row['owner_name'].'</td><td>'.$row['father_name'].'</td><td>'.$row['mother_name'].'</td><td>'.$row['occupation'].'</td><td>'.$row['type_of_house'].'</td><td>'.$row['total_land'].'</td><td>'.$row['source_of_income'].'</td><td>'.$row['nid'].'</td><td>'.$row['proverty_line'].'</td><td>'.$row['price_of_house'].'</td><td>'.$row['mobile_no'].'</td><td>'.$row['imopsed_tax'].'</td><td>'.$row['previous_due'].'</td><td>'.$row['fiscal_year'].'</td><td>'.$row['profile_pic'].'</td><td>'.$row['nid_photo'].'</td><td>'.$row['union_code'].'</td><td>'.$row['date'].'</td></tr>';
}

$html .='</table>';
header('Content-Type:application/xls');
header('Content-Disposition:attachment;filename=report.xls');
echo $html;

?>