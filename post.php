<?php
require 'inc/Functions.php';
$json = file_get_contents('php://input');
$data = json_decode($json);
$assesmentdata = isset($data->getnid)?$data:NULL;
$asstable = isset($data->getyear)?$data:NULL;
$sendandg = isset($data->sendid)?$data:NULL;
if($sendandg !==NULL){
    $survey = new Survey();
    $assid = $sendandg->assesid;
    $members = $sendandg->members;
    $bol_status = false;
    foreach($members as $member){
        $name = $member->name;
        $occupation = $member->occupation;
        $sql = "INSERT INTO family_member(member_name,member_occupation,assesmentid) VALUES('$name','$occupation','$assid')";
        if($survey->con->query($sql)===TRUE){
            $bol_status = true;
        }else{
            $bol_status = false;
        }
    }
    if($bol_status){
      echo json_encode(array(
        'response'=>$sendandg->members
    ));
    }else{
      echo json_encode(array(
        'errr'=>'error occured'
    ));
    }
    
}
if($assesmentdata !==NULL){
    $nid = $assesmentdata->nid;
    $unioncode = $assesmentdata->unionCode;
    $survey = new Survey();
    $nidtodom = $survey->nidtodom($nid,$unioncode);
}
if($asstable !==NULL){
    $code = $asstable->year;
    $holding = $asstable->holding;
    $survey = new Survey();
    $yeartodom = $survey->yeartodom($code,$holding);
}

?>