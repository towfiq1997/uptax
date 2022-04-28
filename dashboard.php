<?php 
session_start();
include_once("inc/Functions.php");
$username = isset($_SESSION['email']) ? $_SESSION['email'] : NULL;
if ($username == NULL) {
    header('location:index.php');
}
include 'templates/header.php';
 ?>
<div class="col-xl-4">
    <div class="card">
        <div class="card-body text-center bangla">
            <h3>মোট ডাটা</h3>
            <h3 style="margin:0">
                <?php
                $dashboard = new Survey();
                $code = $_SESSION['code'];
                  $sql = "SELECT * FROM assesment_input WHERE union_code='$code'";
                  $excute = $dashboard->con->query($sql);
                  $row_count = $excute->num_rows;
                  echo $row_count;
                
                ?>
            </h3>
        </div>
    </div>
</div>
<?php
    $sql = "SELECT DISTINCT ward_no FROM assesment_input WHERE union_code='$code'";
    $excute = $dashboard->con->query($sql);
    while($row=$excute->fetch_assoc()){
         $wardno = $row['ward_no'];
         $sql2 = "SELECT * FROM assesment_input WHERE ward_no='$wardno'";
         $excute2 = $dashboard->con->query($sql2);
         $row_count_ward =  $excute2->num_rows; ?>
<div class="col-xl-4" style="margin-bottom:20px">
    <div class="card">
        <div class="card-body text-center bangla">
            <h3><?php echo "ওয়ার্ড নং ".$wardno; ?></h3>
            <h3 style="margin:0">
                <?php echo $row_count_ward; ?>
            </h3>
        </div>
    </div>
</div>

<?php }
    ?>
<?php include 'templates/footer.php'; ?>