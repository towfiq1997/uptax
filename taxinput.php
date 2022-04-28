<?php 
session_start();
include_once("inc/Functions.php");
$username = isset($_SESSION['email']) ? $_SESSION['email'] : NULL;
if ($username == NULL) {
    header('location:index.php');
}

if(isset($_POST['submit'])){
    
    if($_POST['amount_']==""){
         echo "Amount should be given";
    }else{
    $assid = $_POST['assid'];
    $type_of_tax = $_POST['type_of_tax'];
    $year = $_POST['year'];
    $due_tax = isset($_POST['due_tax'])?$_POST['due_tax']:0;
    $amount = $_POST['amount_'];
    $union_code = $_SESSION['code'];
    $addtax = new Survey();
    if($due_tax==""){
        
    }else{
       $sql = "SELECT previous_due FROM assesment_input WHERE id='$assid'";
            $due_res = $addtax->con->query($sql);
            $due_row = $due_res->fetch_assoc();
            $p_duee = $due_row['previous_due'];
            if($due_tax<$p_duee){
                $cr_p_due = $p_duee-$due_tax;
                $sql = "UPDATE assesment_input SET previous_due='$cr_p_due' WHERE id='$assid'";
                if($addtax->con->query($sql)===TRUE){
                    
                }
                
            }else if($due_tax==$p_duee){
                $cr_p_due = $p_duee-$due_tax;
                $sql = "UPDATE assesment_input SET previous_due='$cr_p_due' WHERE id='$assid'";
                if($addtax->con->query($sql)===TRUE){
                    
                }
            }
    }
    $union_codee = $_SESSION['code'];
    $sql = "SELECT * FROM tax_input WHERE nid='$assid' AND year ='$year' AND type_of_tax='$type_of_tax' AND union_code='$union_code'";

    $result1 = $addtax->con->query($sql);

    if($result1->num_rows>0){
    $row1 = $result1->fetch_assoc();
    if($type_of_tax==="land_house_tax"){
       $sql = "SELECT assesment_input.imopsed_tax,assesment_input.previous_due,tax_input.amount FROM assesment_input INNER JOIN tax_input ON assesment_input.id=tax_input.nid WHERE tax_input.nid='$assid' AND tax_input.type_of_tax='$type_of_tax' AND tax_input.year='$year'";
       $result2 = $addtax->con->query($sql);
       $row2 = $result2->fetch_assoc();
       $rest_amount = $row2['imopsed_tax']-$row2['amount'];

       if($amount>$rest_amount){
          exit($rest_amount."টাকা বাকি এর বেশি দেওয়া যাবেনা <a href='../survey/taxinput'>আগের মেনুতে ফেরত</a>");
       }
       else if($amount<=$rest_amount){
                if($row2['previous_due']=="0"){
                    echo "Entry Prohibited";
                }else{
                   
                $full_amount = $row2['amount'] + $amount;
                $sql = "UPDATE tax_input SET amount='$full_amount' WHERE nid='$assid'";
                
                if($addtax->con->query($sql)===TRUE){
                $full_due = $row2['previous_due']-$amount;
                $sql = "UPDATE assesment_input SET previous_due='$full_due' WHERE id='$assid'";
                if($addtax->con->query($sql)===TRUE){
                    header("location:testing.php?type=$type_of_tax&year=$year&amount=$amount&nid=$assid&due=$due_tax&union_code=$union_code");
                }

            }

                }
                

          }
       }else{

            $sql="SELECT * FROM tax_input WHERE nid='$assid' AND type_of_tax='$type_of_tax' AND year='$year'";
            $result = $addtax->con->query($sql);
            $row = $result->fetch_assoc();
            $cr_amount = $row['amount']+$amount;
            echo $cr_amount;
            $sql = "UPDATE tax_input SET amount='$cr_amount' WHERE nid='$assid' AND type_of_tax='$type_of_tax' AND year='$year'";
            if($addtax->con->query($sql)===TRUE){
                    header("location:testing.php?type=$type_of_tax&year=$year&amount=$amount&nid=$assid&due=$due_tax&union_code=$union_code");
                }
       }
    }
    else{
        if($type_of_tax==="land_house_tax"){
             $sql = "SELECT imopsed_tax,previous_due FROM assesment_input WHERE id='$assid'";
            $result2 = $addtax->con->query($sql);
            $row2 = $result2->fetch_assoc();
             if($amount>$row2['imopsed_tax']){
                 exit("আরোপিত কর থেকে বেশি দেওয়া যাবেনা <a href='../survey/taxinput'>আগের মেনুতে ফেরত</a>");
             }
             else if($amount<=$row2['imopsed_tax']){
                  $previous_due = $row2['previous_due'];
                  $due_now = $row2['imopsed_tax']-$amount;
                  $full_due = $previous_due+$due_now;
                  $sql = "UPDATE assesment_input SET previous_due='$full_due' WHERE id='$assid'";
                  if($addtax->con->query($sql)===TRUE){
                       //$full_amount = $row1['amount'] + $amount;

                       $sql = "INSERT into tax_input (nid,year,type_of_tax,amount,union_code) VALUES('$assid','$year','$type_of_tax','$amount','$union_code')";
                      if($addtax->con->query($sql)===TRUE){
                           header("location:testing.php?type=$type_of_tax&year=$year&amount=$amount&nid=$assid&due=$due_tax&union_code=$union_code");
                         }
                    }

                }
        }else{
           $sql = "INSERT into tax_input (nid,year,type_of_tax,amount) VALUES('$assid','$year','$type_of_tax','$amount')";
              if($addtax->con->query($sql)===TRUE){
                    header("location:testing.php?type=$type_of_tax&year=$year&amount=$amount&nid=$assid&due=$due_tax&union_code=$union_code");
                }
            }
         }

    }
       
}
include 'templates/header.php';
?>
<div class="col-xl-12">

    <div class="input-group mb-4" id="pushdiv">
        <input data-unioncode="<?php echo $_SESSION['code']; ?>" id="getnidno" type="text"
            class="bangla form-control bg-light border-1 small" placeholder="এনআইডি দিয়ে তথ্য খুজুন.........."
            aria-label="Search" aria-describedby="basic-addon2" style="border-color: #3f51b5;">
        <div class="input-group-append">
            <button class="btn btn-primary" type="button">
                <i class="fas fa-search fa-sm"></i>
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="row">
                <div class="col-md-12">
                    <div style="min-height:500px" class="card bangla">
                        <div class="card-body" id="push_item">
                            <div style="height:500px" class="d-flex justify-content-center align-items-center">
                                <div class="alert alert-primary bangla" role="alert">
                                    উপেরের ইনপুট বক্সে এনআইডি নং দিয়ে তথ্য যাছাই এর পর ট্যাক্স এড করুন
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-body bangla">
                    <form id="myForm" method="POST">
                        <fieldset id="fieldset_attr" disabled>
                            <input type="text" name="assid" value="" class="d-none" id="assid">
                            <div class="form-group">
                                <label for="exampleInputEmail1">বছর</label>
                                <select name="year" class="form-control" id="exampleFormControlSelect1">
                                    <option value="2021-2022">২০২১-২০২২</option>
                                    <option value="2022-2023">২০২২-২০২৩</option>
                                    <option value="2023-2024">২০২৩-২০২৪</option>
                                    <option value="2024-2025">২০২৪-২০২৫</option>
                                    <option value="2025-2026">২০২৫-২০২৬</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">করের ধরন</label>
                                <select name="type_of_tax" class="form-control">
                                    <option value="land_house_tax">জমি ও অট্টালিকা</option>
                                    <option value="trade_lisence"> ট্যাক্স ট্রেড লাইসেন্স ফি</option>
                                    <option value="others_tax">অন্যান্য</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">টাকার পরিমান</label>
                                <input name="amount_" type="number" class="form-control" id="tax_amount"
                                    placeholder="টাকার পরিমান লিখুন">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">বকেয়া পরিশুধ</label>
                                <input name="due_tax" id="disabledTextInput" type="number" class="form-control"
                                    placeholder="টাকার পরিমান লিখুন">
                            </div>
                            <input type="submit" value="Submit" name="submit" class="btn btn-primary" />
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-5 ">
            <div class="tax_data_container" id="t_container">
            </div>
        </div>
    </div>
</div>
<?php include 'templates/footer.php'; ?>