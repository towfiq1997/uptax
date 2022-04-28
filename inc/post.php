<?php
include 'Functions.php';
if(isset($_POST['ward'])){
    $add_data = new Survey();
    $ward = $_POST['ward'];
    $holding = $_POST['holding'];
    $name = $_POST['ownername'];
    $father_name = $_POST['fname'];
    $mother_name = $_POST['mname'];
    $village = $_POST['village'];
    $mobile = $add_data->english_convertor($_POST['mobile']);
    $nid = $add_data->english_convertor($_POST['nid']);
    $unioncode = $_POST['union_code'];
    
    $filename = isset($_FILES['profilephoto']['name'])?rand(1000,10000)."-".$_FILES['profilephoto']['name']:"empty";
    $tmp_name = isset($_FILES['profilephoto']['tmp_name'])?$_FILES['profilephoto']['tmp_name']:"empty";
    $new_finale_name = strtolower($filename);
    $finale_file = str_replace(' ','-',$new_finale_name);
    
    move_uploaded_file($tmp_name,"../uploads/".$finale_file);
    
    $filename2 = isset($_FILES['nidphoto']['name'])?rand(1000,10000)."-".$_FILES['nidphoto']['name']:"empty";
    $tmp_name2 = isset($_FILES['nidphoto']['tmp_name'])?$_FILES['nidphoto']['tmp_name']:"empty";
    $new_finale_name2 = strtolower($filename2);
    $finale_file2 = str_replace(' ','-',$new_finale_name2);

    move_uploaded_file($tmp_name2,"../uploads/".$finale_file2);

    $total_land = $_POST['land'];
    $occupation = $_POST['occupation'];
    $proverty_line = $_POST['line'];
    $price_of_house = $_POST['price'];
    $tax = $add_data->english_convertor($_POST['tax']);
    $due_tax = $add_data->english_convertor($_POST['due']);
    $type_of_house = $_POST['type'];

    $sql = "INSERT INTO assesment_input(ward_no,holding_no,owner_name,father_name,mother_name,village,occupation,type_of_house,total_land,nid,proverty_line,price_of_house,mobile_no,imopsed_tax,previous_due,fiscal_year,profile_pic,nid_photo,union_code) VALUES('$ward','$holding','$name','$father_name','$mother_name','$village','$occupation','$type_of_house','$total_land','$nid','$proverty_line','$price_of_house','$mobile','$tax','$due_tax','22','$finale_file','$finale_file2','$unioncode')";
     $insertdata = $add_data->insertd($sql);
}

?>