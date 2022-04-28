<?php 
session_start();
include_once("inc/Functions.php");
$username = isset($_SESSION['email']) ? $_SESSION['email'] : NULL;
if ($username == NULL) {
    header('location:index.php');
}
if(isset($_POST['submit'])){
    if($_POST['confirm']==="confirm"){
        header("location:year_change.php");
    }
}
include 'templates/header.php';
?>
<div class="col-md-12 text-center">
    <!-- <h3>Confirm By Passcode</h3> -->
    <form action="" method="post">
        <input type="password" name="confirm" id="">
        <input type="submit" name="submit" value="Confirm">
    </form>
</div>

<?php include 'templates/footer.php';?>