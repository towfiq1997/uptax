<?php 
session_start();
include_once("inc/Functions.php");
$username = isset($_SESSION['email']) ? $_SESSION['email'] : NULL;
if ($username == NULL) {
    header('location:index.php');
}
include 'templates/header.php';
$id = isset($_GET['id'])?$_GET['id']:NULL;
$viewdata = new Survey();
$sql = "SELECT * FROM assesment_input WHERE id='$id'";
$excute = $viewdata->con->query($sql);
$row = $excute->fetch_assoc();
?>
<div class="col-md-12">
    <div style="margin-bottom:20px" class="view-container d-flex justify-content-between align-items-center">
        <img src="<?php echo $row['profile_pic']; ?>" width="200px" height="200px" alt="">
        <img src="<?php echo $row['nid_photo']; ?>" width="200px" height="200px" alt="">
    </div>
    <div style="margin-bottom:20px" class="view-container d-flex justify-content-between align-items-center bangla">
        <h5>মালিকের নাম <?php echo $row['owner_name'];?></h5>
        <h5>পিতার নাম <?php echo $row['father_name']; ?></h5>
    </div>
    <div style="margin-bottom:20px" class="view-container d-flex justify-content-between align-items-center bangla">
        <h5>মাতার নাম <?php echo $row['mother_name'];?></h5>
        <h5>গ্রাম <?php echo $row['village']; ?></h5>
    </div>
    <div style="margin-bottom:20px" class="view-container d-flex justify-content-between align-items-center bangla">
        <h5>এন আই ডি <?php echo $row['nid'];?></h5>
        <h5>মোবাইল নং <?php echo $row['mobile_no']; ?></h5>
    </div>
    <div style="margin-bottom:20px" class="view-container d-flex justify-content-between align-items-center bangla">
        <h5>পেশা <?php echo $row['occupation'];?></h5>
        <h5>বাড়ির ধরন <?php echo $row['type_of_house']; ?></h5>
    </div>
    <div style="margin-bottom:20px" class="view-container d-flex justify-content-between align-items-center bangla">
        <h5>ধার্যকৃত ট্যাক্স <?php echo $row['imopsed_tax'];?></h5>
        <h5>বকেয়া ট্যাক্স <?php echo $row['previous_due']; ?></h5>
    </div>
    <div style="margin-bottom:20px" class="view-container d-flex justify-content-between align-items-center bangla">
        <h5>দারিদ্র সীমা <?php echo $row['proverty_line'];?></h5>
        <h5>জমির পরিমাণ <?php echo $row['total_land']; ?></h5>
    </div>
    <h3 class="bangla">ফ্যামিলি মেম্বার</h3>
    <table class="table bangla">
        <tr>
            <th>নাম</th>
            <th>পেশা</th>
        </tr>
        <?php
        $sql = "SELECT * FROM family_member WHERE assesmentid='$id'";
        $excute = $viewdata->con->query($sql);
        while($row=$excute->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $row['member_name']; ?></td>
            <td><?php echo $row['member_occupation']; ?></td>
        </tr>
        <?php }
        ?>
    </table>
</div>

<?php include 'templates/footer.php'; ?>