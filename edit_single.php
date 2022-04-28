<?php 
session_start();
include_once("inc/Functions.php");
$username = isset($_SESSION['email']) ? $_SESSION['email'] : NULL;
if ($username == NULL) {
    header('location:index.php');
}
include 'templates/header.php';
$editass = new Survey();

$assid = $_GET['id'];
$sql = "SELECT * FROM assesment_input WHERE id='$assid'";
$res = $editass->con->query($sql);
$row = $res->fetch_assoc();


if(isset($_POST['submit'])){
$ward = $_POST['ward_no'];
$holding = $_POST['holding_no'];
$name = $_POST['owner_name'];
$father_name = $_POST['f_name'];
$mobile = $_POST['mobile_no'];
$nid = $_POST['nid_no'];
$occupation = $_POST['occupation'];
$total_land = $_POST['total_land'];
$price_of_house = $_POST['price_of_house'];
$tax = $editass->english_convertor($_POST['tax']);
$due_tax = $editass->english_convertor($_POST['p_due']);
$type_of_house = $_POST['type_of_house'];

$sql = "UPDATE assesment_input SET
ward_no='$ward',holding_no='$holding',owner_name='$name',father_name='$father_name',total_land='$total_land',nid='$nid',price_of_house='$price_of_house',mobile_no='$mobile',imopsed_tax='$tax',previous_due='$due_tax',occupation='$occupation',type_of_house='$type_of_house'
WHERE id='$assid'";
$insertdata = $editass->update_ass($sql);

}
?>
<div class="col-md-12">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 bangla">তথ্য এডিট</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item bangla"><a href="./">হোমপেইজ</a></li>
            <li class="breadcrumb-item active bangla" aria-current="page">তথ্য এডিট</li>
        </ol>
    </div>
</div>
<div class="col-xl-12">
    <?php
       if(isset($insertdata)){
           echo $insertdata;
       }
    ?>
    <form method="POST" class="bangla" enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">ওয়ার্ড নং
                </label>
                <input name="ward_no" value="<?php echo $row['ward_no']; ?>" type="text" class="form-control"
                    id="inputEmail4" placeholder="ওয়ার্ড নং">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">হোল্ডিং নং</label>
                <input name="holding_no" value="<?php echo $row['ward_no']; ?>" type="text" class="form-control"
                    id="inputPassword4" placeholder="হোল্ডিং নং">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">মালিকের নাম</label>
                <input value="<?php echo $row['owner_name']; ?>" name="owner_name" type="text" class="form-control"
                    id="inputEmail4" placeholder="মালিকের নাম">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">পিতার নাম</label>
                <input value="<?php echo $row['father_name']; ?>" name="f_name" type="text" class="form-control"
                    id="inputPassword4" placeholder="পিতার নাম">
            </div>
        </div>
        <!-- <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">মালিকের ছবি</label>
                <input name="profile_photo" type="file" class="form-control" id="inputEmail4" placeholder="মালিকের নাম">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">এন আই ডি ছবি</label>
                <input  name="nid_photo" type="file" class="form-control" id="inputPassword4" placeholder="পিতার নাম">
            </div>
        </div> -->
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">এন আই ডি
                </label>
                <input value="<?php echo $row['nid']; ?>" name="nid_no" type="text" class="form-control"
                    id="inputEmail4" placeholder="এন আই ডি">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">মোবাইল নং</label>
                <input value="<?php echo $row['mobile_no']; ?>" name="mobile_no" type="text" class="form-control"
                    id="inputPassword4" placeholder="মোবাইল নং">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputPassword4">বাড়ির ধরন
                </label>
                <select name="type_of_house" class="form-control" id="exampleFormControlSelect1">
                    <option value="paka">পাকা</option>
                    <option value="semi-paka">সেমি পাকা</option>
                    <option value="kacha">কাচা</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="inputEmail4">পেশা</label>
                <select name="occupation" class="form-control" id="exampleFormControlSelect1">
                    <option value="mojor">মজুর</option>
                    <option value="chakuri">চাকুরী</option>
                    <option value="probasi">প্রবাসী</option>
                    <option value="krisi">কৃষি</option>
                    <option value="bebsa">ব্যবসা</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">ধার্যকৃত ট্যাক্স</label>
                <input value="<?php echo $editass->bangla_convertor($row['imopsed_tax']); ?>" name="tax" type="text"
                    class="form-control" id="inputEmail4" placeholder="ধার্যকৃত ট্যাক্স">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">বকেয়া ট্যাক্স</label>
                <input value="<?php echo $editass->bangla_convertor($row['previous_due']); ?>" name="p_due" type="text"
                    class="form-control" id="inputPassword4" placeholder="বকেয়া ট্যাক্স">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">বাড়ির মূল্য
                </label>
                <input <?php echo $row['price_of_house']; ?> name="price_of_house" type="text" class="form-control"
                    id="inputEmail4" placeholder="বাড়ির মূল্য">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">জমির পরিমাণ</label>
                <input <?php echo $row['total_land']; ?> name="total_land" type="text" class="form-control"
                    id="inputPassword4" placeholder="জমির পরিমাণ">
            </div>
        </div>
        <input type="submit" name="submit" class="btn btn-primary" value="Submit">
    </form>
</div>
<?php include 'templates/footer.php'; ?>