<?php
session_start();
include_once("inc/Functions.php");
        require_once __DIR__ . '/vendor/autoload.php';
        $addtax = new Survey();
        $english = array('1','2','3','4','5','6','7','8','9','0');
        $bangla = array('১','২','৩','৪','৫','৬','৭','৮','৯','০');
        // $converted = str_replace($english,$bangla,$amount);
        $unioncode = $_SESSION['code'];
        $sql = "SELECT owner_name,father_name,mother_name,ward_no,holding_no,previous_due,nid,imopsed_tax,mobile_no,village FROM assesment_input WHERE union_code='$unioncode' ORDER BY holding_no ASC";
        $sql2 = "SELECT name,thana,zilla,union_code,postal_code,logo,post_office_name FROM union_info WHERE union_code='$unioncode '";
        
        $ass_res = $addtax->con->query($sql);
        $union_res = $addtax->con->query($sql2);
        //$row_ass = $ass_res->fetch_assoc();
        $row_uni = $union_res->fetch_assoc();

        $union_name = $row_uni['name'];
        $thana = $row_uni['thana'];
        $zilla = $row_uni['zilla'];
        $post_office_name = $row_uni['post_office_name'];
        $postal_code = $addtax->bangla_convertor($row_uni['postal_code']);
        $union_code = $addtax->bangla_convertor($row_uni['union_code']);

        

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
    'format'=> [420,297],
    'margin_header'=>5,
    'margin_footer'=>0,
    'margin_top'=>30,
    'margin_bottom'=>10,
    'margin_left'=>10,
    'margin_right'=>10,
]);   
$header_html = "<div style='text-align:center'>
        <h2  style='margin:0;font-size:40px'>$union_name</h2>
        <h4 style='margin:0;font-size:25px'>থানাঃ $thana জেলাঃ $zilla-$postal_code</h4>
        </div>";
        $innertable = "";
        $serial = 1;
        while($row_ass = $ass_res->fetch_assoc()){
        $banglaserial = $addtax->bangla_convertor($serial);
        $ownername = $row_ass['owner_name'];
        $fathersname = $row_ass['father_name'];
        $mothername = $row_ass['mother_name'];
        $village =$row_ass['village'];
        $mobileno = $addtax->bangla_convertor($row_ass['mobile_no']);
        $imposedtax = $addtax->bangla_convertor($row_ass['imopsed_tax']);
        $nid = $addtax->bangla_convertor($row_ass['nid']);
        $previous_due = $addtax->bangla_convertor($row_ass['previous_due']);
        $ward = $addtax->bangla_convertor($row_ass['ward_no']);
        $holding = $addtax->bangla_convertor($row_ass['holding_no']);
        $innertable .= "<tr>
        <td align='center' style='font-size: 18pt;'>$banglaserial</td>
        <td colspan='3' align='center' style='font-size: 18pt;'>$ownername</td>
        <td colspan='3' align='center' style='font-size: 18pt;'>$fathersname</td>
        <td colspan='3' align='center' style='font-size: 18pt;'>$mothername</td>
        <td align='center' style='font-size: 18pt;'>$ward</td>
        <td align='center' style='font-size: 18pt;'>$village</td>
        <td align='center' style='font-size: 18pt;'>$holding</td>
        <td align='center' style='font-size: 18pt;'>$nid</td>
        <td align='center' style='font-size: 18pt;'>$mobileno</td>
        <td align='center' style='font-size: 18pt;'>$imposedtax</td>
        <td align='center' style='font-size: 18pt;'>$previous_due</td>
        </tr>";

        $serial++;

        }

      $table = "<table cellspacing='0' cellpadding='5' border='1' width='100%'>
      <tr>
      <td align='center' style='font-size: 18pt;'>ক্রমিক</td>
      <td colspan='3' align='center' style='font-size: 18pt;'>মালিকের নাম</td>
      <td colspan='3' align='center' style='font-size: 18pt;'>পিতার নাম</td>
      <td colspan='3' align='center' style='font-size: 18pt;'>মাতার নাম</td>
      <td align='center' style='font-size: 18pt;'>ওয়ার্ড নং</td>
      <td align='center' style='font-size: 18pt;'>গ্রাম</td>
      <td align='center' style='font-size: 18pt;'>হোল্ডিং নং</td>
      <td align='center' style='font-size: 18pt;'>এনাইডি নং</td>
      <td align='center' style='font-size: 18pt;'>মোবাইল নং</td>
      <td align='center' style='font-size: 18pt;'>ধার্যকৃত ট্যাক্স </td>
      <td align='center' style='font-size: 18pt;'>বকেয়া</td>
      </tr>
      $innertable
      </table>";
        $filename = "file".rand(100,5000).".pdf";
        $mpdf->SetHTMLHeader($header_html);

        $today_date = date("Y/m/d");
        $date = $addtax->bangla_convertor($today_date);
        $mpdf->SetHTMLFooter('<table border="0" width="100%">
           <tr>
              <td style="font-family:dejavusans;font-weight: bold; font-size: 10pt;" align="left" width="50%">{PAGENO}</td>
              <td style="font-weight: bold; font-size: 10pt;" align="right" width="50%">'.$date.'</td>
           </tr>
</table>');
        $mpdf->WriteHTML($table);
        $mpdf->Output($filename,'I');