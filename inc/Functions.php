<?php
  
class Survey{
    public $con;
    function __construct(){
        include_once("db.php");
		$db = new Database();
		$this->con = $db->connect();
    }
    public function bangla_convertor($data){
        $english = array('1','2','3','4','5','6','7','8','9','0');
        $bangla = array('১','২','৩','৪','৫','৬','৭','৮','৯','০');
        $converted = str_replace($english,$bangla,$data);
        return $converted;
    }
    public function english_convertor($data){
        $english = array('1','2','3','4','5','6','7','8','9','0');
        $bangla = array('১','২','৩','৪','৫','৬','৭','৮','৯','০');
        $converted = str_replace($bangla,$english,$data);
        return $converted;
    }
    public function get_table_data($nid,$type,$year){
          $sql = "SELECT * FROM tax_input WHERE nid='$nid' AND type_of_tax='$type' AND year='$year'";
          $res = $this->con->query($sql);
          if($res->num_rows>0){
          $row = $res->fetch_assoc();
          $amount = $row['amount'];
          return $this->bangla_convertor($amount);
          }else{
           echo "";
          }
    }
    public function gen_tax_table($nid,$year){
          $sql = "SELECT * FROM tax_input WHERE id='$nid' AND year='$year'";
          $res = $this->con->query($sql);
          $html = '';
          if($res->num_rows>0){
             while($row = $res->fetch_assoc()){
             $year = $row['year'];
             $amount = $row['amount'];
             if($row['type_of_tax']=="land_house_tax"){
                $tax = "জমি ও অট্টালিকা";
             }else if($row['type_of_tax']=="trade_lisence"){
                $tax = "ট্যাক্স ট্রেড লাইসেন্স ফি";
             }else{
                $tax ="অন্যান্য";
             }
            $html .= "<tr><td>$year</td><td>$tax</td><td>$amount</td><td>Download</td></tr>";
            }
         }
            return $html;
    }
    public function nidtodom($nid,$u_code){
         $sql = "SELECT * FROM assesment_input WHERE id='$nid' AND union_code='$u_code'";
         $res = $this->con->query($sql);
         
         if($res->num_rows>0){
             $row = $res->fetch_assoc();
             $house_type = $row['type_of_house'];
             if($house_type=="paka"){
                  $typee = "পাকা";
             }else if($house_type=="semi-paka"){
                  $typee = "সেমি পাকা";
             }else{
                  $typee = "কাচা";
             }
              extract($row);
         $html = '<div class="single_data text-center">
                                <img class="item-image" src="uploads/'.$profile_pic.'" alt="">
                            </div>
                            <div class="single_data d-flex justify-content-between align-items-center">
                                <p>নামঃ '.$owner_name.'</p>
                                <p>পিতার নামঃ '.$father_name.'</p>
                            </div>
                            <div class="single_data d-flex justify-content-between align-items-center">
                                <p>এন.আইডি.ডিঃ '.$nid.'</p>
                                <p>মোবাইলঃ '.$mobile_no.'</p>
                            </div>
                            <div class="single_data d-flex justify-content-between align-items-center">
                                <p>ওয়ার্ড নংঃ '.$ward_no.'</p>
                                <p>হোল্ডিং নংঃ '.$holding_no.'</p>
                            </div>
                            <div class="single_data d-flex justify-content-between align-items-center">
                                <p>এস্যাসমেন্ট নংঃ '.$id.'</p>
                                <p>বাড়ির ধরনঃ '.$typee.'</p>
                            </div>
                            <div class="single_data d-flex justify-content-between align-items-center">
                                <p>মোট জমির পরিমাণঃ '.$total_land.'</p>
                                <p>বাড়ির মূল্যঃ '.$price_of_house.'</p>
                            </div>
                            <div class="single_data d-flex justify-content-between align-items-center">
                                <p>ধার্যকৃত ট্যাক্সঃ '.$imopsed_tax.'</p>
                                <p>পূর্বের বকেয়াঃ '.$previous_due.'</p>
                            </div>';
         $assesment = array();
         $assesment['p_data'] = $html;
         $content21 = $this->gen_tax_table($id,"2021");
         $content22 = $this->gen_tax_table($id,"2022");
         $content23 = $this->gen_tax_table($id,"2023");
         $content24 = $this->gen_tax_table($id,"2024");
         $content25 = $this->gen_tax_table($id,"2025");

         $table = "<table class='table bangla'><tr><th scope='col'>বছর</th><th scope='col'>করের ধরন</th><th scope='col'>টাকার পরিমান</th><th scope='col'>রশিদ</th></tr>$content21.$content22.$content23.$content24.$content25</table>";
         $assesment['res'] =$id;
         $assesment['res2']=$table;

         //array_push($assesment['p_data'],$row);
         echo json_encode($assesment)."\n";
         }
    }

    public function yeartodom($code,$holding){
        $sql = "SELECT * FROM assesment_input WHERE holding_no='$holding' AND union_code='$code'";
        $res = $this->con->query($sql);
        $json_res = array();
        $json_res['tablerow'] = "";
        while($row=$res->fetch_assoc()){
            extract($row);
            $json_res['tablerow'].="<tr>
            <td>
               <img height='80px' width='80px' src='uploads/".$profile_pic."' alt=''>
            </td>
            <td>$id</td>
            <td>$owner_name</td>
            <td>$father_name</td>
            <td>$mother_name</td>
            <td>$nid</td>
            <td>$ward_no</td>
            <td>$holding_no</td>
            <td>$imopsed_tax</td>
            <td>$previous_due</td>
            <td>
               <div class='action-section'>
                                <a style='margin-right:10px !important; text-decoration:none'
                                    href='view_single.php?id=$id'>ভিউ</a>
                                <a style='margin-right:10px !important; text-decoration:none'
                                    href='edit_single.php?id=$id'>এডিট</a>
                                    <a style='margin-right:10px !important; text-decoration:none'
                                    href='delete_single.php?id=$id'>ডিলিট</a>
                            </div>
              </td>
            </tr>";

}
echo json_encode($json_res);
}
public function insertd($sql){
    if($this->con->query($sql)===TRUE){
       echo json_encode(array(
           'last_id'=>$this->con->insert_id,
       ));
    }else{
        echo json_encode(array(
            'error'=>"Error occured",
        ));
    }
//    $res = $this->con->query($sql);
//    if($res){

//        return $this->con->insert_id;
//    }
}
public function insert($sql){
if($this->con->query($sql)===TRUE){
return '<div class="alert alert-success"><i class="fas fa-check"></i> তথ্য সফল ভাবে সংযুক্ত হয়েছে</div>';
}else{
return '<div class="alert alert-error"><i class="fas fa-times"></i>Something Went Wrong</div>';
}
}
public function update_ass($sql){
if($this->con->query($sql)===TRUE){
return '<div class="alert alert-success"><i class="fas fa-check"></i> তথ্য সফল ভাবে আপডেট হয়েছে</div>';
}else{
return '<div class="alert alert-error"><i class="fas fa-times"></i>Something Went Wrong</div>';
}
}
public function login($email,$password,$unioncode){
$pre_stmt = $this->con->prepare("SELECT union_code,name,adminname,adminemail,adminpassword FROM union_info WHERE adminemail = ? && adminpassword = ? && union_code = ?");
$pre_stmt->bind_param("ssi", $email, $password,$unioncode);
$pre_stmt->execute() or die($this->conn->error);
$result = $pre_stmt->get_result();
if($result->num_rows<1){
    return '<div id="demo" class="alert alert-error"><i class="fas fa-times"></i>Password or email incorrect</div>' ;
    }else{ 
    $row = $result->fetch_assoc();
    $union_name = $row['name'];
    $union_code = $row['union_code'];
    $admin_username = $row['adminemail'];
    $_SESSION['email'] =  $admin_username;
    $_SESSION['code'] = $union_code;
    $_SESSION['unionname'] =$union_name;
    header('location:dashboard?username='.$admin_username.'&uinoncode='.$union_code.'');

    }
    }


    }

    ?>