<?php 
header("Content-type:application/pdf");
        include 'inc/Functions.php';
        require_once __DIR__ . '/vendor/autoload.php';
        $addtax = new Survey();
        function get_local($type,$y_r,$match_t,$match_y,$amount){
             if($type===$match_t && $y_r===$match_y){
        $english = array('1','2','3','4','5','6','7','8','9','0');
        $bangla = array('১','২','৩','৪','৫','৬','৭','৮','৯','০');
        $converted = str_replace($english,$bangla,$amount);
        return $converted;
        }else{
                 return "";
             }
        }

        function get_due($prev_due,$match_year,$new_year){
              if($match_year==$new_year){
                  return $prev_due;
              }
              return "";
        }
        function get_full_amount($tax_due,$deposite_amount,$addtax){
                 if($tax_due==""){
                     return $addtax->bangla_convertor($deposite_amount);
                 }
                     return $addtax->bangla_convertor($deposite_amount+$tax_due);
        }
        
        $type_of_tax = $_GET['type'];
        $year = $_GET['year'];
        $amount = $_GET['amount'];
        $assid = $_GET['nid'];
        $due_eng = $_GET['due'];
        $due_tax = $addtax->bangla_convertor($_GET['due']);
        $sql = "SELECT id,owner_name,father_name,ward_no,holding_no,previous_due FROM assesment_input WHERE id='$assid'";
        $sql2 = "SELECT name,thana,zilla,union_code,postal_code,logo,post_office_name FROM union_info";
        
        $ass_res = $addtax->con->query($sql);
        $union_res = $addtax->con->query($sql2);
        $row_ass = $ass_res->fetch_assoc();
        $row_uni = $union_res->fetch_assoc();

        $union_name = $row_uni['name'];
        $thana = $row_uni['thana'];
        $zilla = $row_uni['zilla'];
        $post_office_name = $row_uni['post_office_name'];
        $postal_code = $addtax->bangla_convertor($row_uni['postal_code']);
        $union_code = $addtax->bangla_convertor($row_uni['union_code']);

        $assesmentnumber = $addtax->bangla_convertor($row_ass['id']);
        $ownername = $row_ass['owner_name'];
        $fathersname = $row_ass['father_name'];
        $previous_due = $addtax->bangla_convertor($row_ass['previous_due']);
        $ward = $addtax->bangla_convertor($row_ass['ward_no']);
        $holding = $addtax->bangla_convertor($row_ass['holding_no']);
        $today_date = date("Y/m/d");
        $date = $addtax->bangla_convertor($today_date);

        $bangla_amount = $addtax->bangla_convertor($amount);
        
        $fulll = get_full_amount($due_eng,$amount,$addtax);

        $d_1=get_due($due_tax,$year,'2021-2022');
        $d_2=get_due($due_tax,$year,'2022-2023');
        $d_3=get_due($due_tax,$year,'2023-2024');
        $d_4=get_due($due_tax,$year,'2024-2025');
        $d_5=get_due($due_tax,$year,'2025-2026');

        $l_1=get_local("land_house_tax","2021-2022",$type_of_tax,$year,$amount);
        $l_2=get_local("land_house_tax","2022-2023",$type_of_tax,$year,$amount);
        $l_3=get_local("land_house_tax","2023-2024",$type_of_tax,$year,$amount);
        $l_4=get_local("land_house_tax","2024-2025",$type_of_tax,$year,$amount);
        $l_5=get_local("land_house_tax","2025-2026",$type_of_tax,$year,$amount);


        $t_1=get_local("trade_lisence","2021-2022",$type_of_tax,$year,$amount);
        $t_2=get_local("trade_lisence","2022-2023",$type_of_tax,$year,$amount);
        $t_3=get_local("trade_lisence","2023-2024",$type_of_tax,$year,$amount);
        $t_4=get_local("trade_lisence","2024-2025",$type_of_tax,$year,$amount);
        $t_5=get_local("trade_lisence","2025-2026",$type_of_tax,$year,$amount);




        $o_1=get_local("others_tax","2021-2022",$type_of_tax,$year,$amount);
        $o_2=get_local("others_tax","2022-2023",$type_of_tax,$year,$amount);
        $o_3=get_local("others_tax","2023-2024",$type_of_tax,$year,$amount);
        $o_4=get_local("others_tax","2024-2025",$type_of_tax,$year,$amount);
        $o_5=get_local("others_tax","2025-2026",$type_of_tax,$year,$amount);

        $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        $mpdf = new \Mpdf\Mpdf([
          'fontDir' => array_merge($fontDirs, [
              __DIR__ . '/font',
            ]),
    'fontdata' => $fontData + [
        'sutonnyomjunicode' => [
            'R' => 'SutonnyOMJunicode.ttf',
            'useOTL' => 0xFF,
            'useKashida' => 75,
        ]
    ],
    'default_font' => 'sutonnyomjunicode',
    'format'=> [160,135],
    'orientation' => 'P',
    'margin_header'=>0,
    'margin_footer'=>0,
    'margin_top'=>6,
    'margin_bottom'=>3,
    'margin_left'=>4,
    'margin_right'=>4,
]);
        $tbl = <<<EOD
        <html>
        <head>
        <style>
        @page *{
            margin-top: 0cm;
            margin-bottom: 0cm;
            margin-left: 0cm;
            margin-right: 0cm;
        }
        div
        </style>
        </head>
        <body>
        <div style="text-align:center" class="mycenter">
        <h2 style="margin:0">$union_name</h2>
        <h4 style="margin:0">থানাঃ $thana জেলাঃ $zilla-$postal_code</h4>
        </div>
        <table border="0" width="100%">
           <tr>
              <td align="left" width="33.33%">এসেসমেন্টঃ $assesmentnumber</td>
              <td  align="center" style="color:red" width="33.3%"><h3>ট্যাক্স আদায়ের রশিদ</h3></td>
              <td align="center" width="33.3%">তারিখঃ $date</td>
           </tr>
        </table>
        <table border="0" width="100%">
           <tr>
              <td align="left" width="50%">মালিকের নামঃ $ownername</td>
              <td align="center" width="50%">পিতা/স্বামীর নামঃ $fathersname</td>
           </tr>
        </table>
        <table border="0" width="100%">
           <tr>
              <td align="left" width="25%">ঠিকানাঃ $ward $holding</td>
              <td align="center" width="25%">পোঃ $postal_code</td>
              <td align="center" width="25%">থানাঃ $thana</td>
              <td align="center" width="25%">জেলাঃ $zilla</td>
           </tr>
        </table>
<table cellspacing="0" cellpadding="5" border="1" width="100%">
    <tr>
        <td>বিবরণ</td>
        <td>২০২১-২০২২</td>
        <td>২০২২-২০২৩</td>
        <td>২০২৩-২০২৪</td>
        <td>২০২৪-২০২৫</td>
        <td>২০২৫-২০২৬</td>
    </tr>
    <tr>
        <td>বাস্তভিটা ট্যাক্স-</td>
        <td align="center"></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>জমি ও অট্রালিকা ট্যাক্স-</td>
        <td align="center">$l_1</td>
        <td align="center">$l_2</td>
        <td align="center">$l_3</td>
        <td align="center">$l_4</td>
        <td align="center">$l_5</td>
    </tr>
    <tr>
        <td>পেশা,ব্যবসা,বানিজ্যের উপর ট্রাক্স-</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>ট্রাক,বাস,গাড়ির ট্যাক্স-</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>ট্রেড লাইসেন্স ফি-</td>
        <td align="center">$t_1</td>
        <td align="center">$t_2</td>
        <td align="center">$t_3</td>
        <td align="center">$t_4</td>
        <td align="center">$t_5</td>
    </tr>
    <tr>
        <td>অন্যান্য-</td>
        <td align="center">$o_1</td>
        <td align="center">$o_2</td>
        <td align="center">$o_3</td>
        <td align="center">$o_4</td>
        <td align="center">$o_5</td>
    </tr>
    <tr>
        <td>বকেয়া-</td>
        <td align="center">$d_1</td>
        <td align="center">$d_2</td>
        <td align="center">$d_3</td>
        <td align="center">$d_4</td>
        <td align="center">$d_5</td>
    </tr>
</table>
<table border="0" width="100%">
           <tr>
              <td align="left" width="50%">পূর্বের বকেয়াঃ $previous_due</td>
              <td align="right" width="50%">জমাকৃত মোট টাকাঃ $fulll</td>
           </tr>
</table>
<div style="margin-top:7;text-align:right">
      <p>আদায়কারীর স্বাক্ষর</p>
</div>
</body>
</html>
EOD;
        $filename = "file".rand(100,5000).".pdf";
        $mpdf->WriteHTML($tbl);
        $mpdf->Output($filename,'D');