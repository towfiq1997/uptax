<?php 
session_start();
include_once("inc/Functions.php");
$username = isset($_SESSION['email']) ? $_SESSION['email'] : NULL;
if ($username == NULL) {
    header('location:index.php');
}
include 'templates/header.php';
if(isset($_POST['submit'])){
    $year_change = new Survey();
    $year = $_POST['year'];
    $year_array = explode("-",$year);
    $first_element = $year_array[0]-1;
    $second_element = $year_array[1]-1;
    $fiscale_year = $first_element."-".$second_element;
    $sql = "SELECT * FROM assesment_input";
    $res = $year_change->con->query($sql);
    while($row = $res->fetch_assoc()){
        $nid = $row['id'];
        $previous_due = $row['previous_due'];
        $imposed_tax = $row['imopsed_tax'];
        // echo $nid;
        // echo $previous_due;
        // echo $imposed_tax;
        // echo $fiscale_year;
        $sql="SELECT * FROM tax_input WHERE nid='$nid' AND type_of_tax='land_house_tax' AND year='$fiscale_year'";
        $result = $year_change->con->query($sql);
        if($result->num_rows>0){
            echo $nid;
        }else{
            $full_amount = $previous_due+$imposed_tax;
            $sql = "UPDATE assesment_input SET previous_due='$full_amount' WHERE id='$nid'";
            if($year_change->con->query($sql)===TRUE){
                echo "Added to due";
            }
        }
        // $sql = "SELECT * FROM tax_input WHERE nid='$nid' AND year='$fiscale_year' AND type_of_tax='land_house_tax'";
        // $res = $year_change->con->query($sql);
        // if($res->num_rows>0){
        //      echo $nid;
        // }else{
        //      echo $nid;
        // }
    }

}
?>
<div class="col-md-6 text-center">
    <form action="" method="POST">
        <div class="form-group bangla">
            <label for="exampleInputEmail1">অর্থবছর পরিবর্তন</label>
            <select name="year" class="form-control " id="exampleFormControlSelect1">
                <option value="2022-2023">২০২২-২০২৩</option>
                <option value="2023-2024">২০২৩-২০২৪</option>
                <option value="2024-2025">২০২৪-২০২৫</option>
                <option value="2025-2026">২০২৫-২০২৬</option>
                <option value="2025-2026">২০২৬-২০২৭</option>
                <option value="2025-2026">২০২৭-২০২৮</option>
                <option value="2025-2026">২০২৮-২০২৯</option>
                <option value="2025-2026">২০২৯-২০৩০</option>
            </select>
        </div>
        <input type="submit" value="পরিবর্তন করুন" name="submit" class="btn btn-primary bangla" />
    </form>
</div>
<?php include 'templates/footer.php'; ?>