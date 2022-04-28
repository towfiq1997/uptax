<?php 
session_start();
include_once("inc/Functions.php");
$username = isset($_SESSION['email']) ? $_SESSION['email'] : NULL;
if ($username == NULL) {
    header('location:index.php');
}
$delete = new Survey();
$uni_code = $_SESSION['code'];
$id = $_GET['id'];

$sql = "DELETE FROM assesment_input WHERE id='$id' AND union_code='$uni_code'";
if($delete->con->query($sql)=== TRUE){
    header("location:assview.php");
}