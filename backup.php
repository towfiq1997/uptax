<?php 
session_start();
include_once("inc/Functions.php");
$username = isset($_SESSION['email']) ? $_SESSION['email'] : NULL;
if ($username == NULL) {
    header('location:index.php');
}
include 'templates/header.php';
 ?>
<div class="col-xl-12 bangla">
    <a href="abcd.php" type="button" class="btn btn-primary mb-1">ডাওনলোড</a>
    <a href="exports.php" type="button" class="btn btn-success mb-1">ব্যাকআপ এক্সেল</a>
</div>
</div>
<?php include 'templates/footer.php'; ?>