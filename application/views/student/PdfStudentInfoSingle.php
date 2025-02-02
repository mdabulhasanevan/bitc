<?php

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Evan Hasan');
$pdf->SetTitle('Student Info'.$Info->RegNo);
$pdf->SetSubject('Student Info');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData('Logo.jpg', 15, 'Barisal Information Technology College BITC', '');

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', 20));

$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------
// set font
$pdf->SetFont('times', '', 12);

// add a page
$pdf->AddPage();

// set cell padding
$pdf->setCellPaddings(1, 1, 1, 1);

// set cell margins
$pdf->setCellMargins(1, 1, 1, 1);

// set color for background
$pdf->SetFillColor(255, 255, 255);

$title = <<<EOD
        <h3>Student Information</h3> 
EOD;
$pdf->writeHTMLCell(0, 0, '', '', $title, 0, 1, 0, true, 'C', true);

$pdf->Image(base_url("uploads/students/").$Info->Photo, 140, '', 40, 40);
$body1 = <<<EOD
        <h5 style="background-color:#dff0d8; font-size:14px; padding:3px;">Faculty Information</h5> 
        <table style="padding:2px;">
        <tr>
        <td>Name </td>
        <td>: $Info->FullName </td>
        </tr>
        <tr>
        <td>Date of Birth</td>
        <td>: $Info->DateOfBirth </td>
        </tr>
        <tr>
        <td>Faculty</td>
        <td>: $Info->FacultyName </td>
        </tr><tr>
        <td>Session</td>       
        <td>: $Info->SessionName</td>
        </tr><tr>
        <td>Reg No</td>
        <td>: $Info->RegNo</td>  
        </tr><tr>
        <td>Student Institute ID</td>
        <td>: $Info->StudentInsID </td> 
        </tr>
        </tr>
        </table>
EOD;

$body2 = <<<EOD
        <h5 style="background-color:#dff0d8; font-size:14px; padding:3px;">Basic Info</h5> 
        <table style="padding:2px;">
        <tr>
        <td>SMS Number </td>
        <td>: $Info->SMSNotificationNo </td>
        
        <td>Father's Name </td>
        <td>: $Info->FatherName </td>
        
        </tr><tr>
        
        <td>Gender</td>
        <td>: $Info->GenderName </td>
       
        
         <td>Father Mobile </td>
        <td>: $Info->FatherMobile </td>
        
        </tr>
        
        <tr>
          
        <td>Blood Group</td>       
        <td>: $Info->BloodGroupName</td>
        
         <td>Mother's Name </td>      
        <td>: $Info->MotherName </td>
                
        </tr><tr>
        
        <td>Religion</td>
        <td>: $Info->ReligionName</td>
        
        <td>Mother Mobile </td>
        <td>: $Info->MotherMobile </td>
        
        </tr><tr>
        
        <td>Nationality</td>
        <td>: $Info->Nationality</td> 
        
        <td> </td>
        <td>: </td>
        
        </tr><tr>
       
        <td>Present Address</td>
        <td>:  $Info->PreAddress, $Info->PreThana, $Info->PreZilaName</td>       
         <td>Present Address</td>
        <td>:  $Info->ParAddress, $Info->ParThana, $Info->ParZilaName</td>
        </tr>
        </table>
EOD;
$body3 = <<<EOD
        <h5 style="background-color:#dff0d8; font-size:14px; padding:3px;">Past Academic Info</h5> 
        <table style="padding:2px;">
        <tr>
        <td>SSC Year </td>
        <td>: $Info->ssc_year </td>
        
        <td>HSC Year </td>
        <td>: $Info->hsc_year </td>
        
        </tr><tr>
        
        <td>SSC Roll</td>
        <td>: $Info->ssc_roll </td>
        
         <td>HSC Roll </td>
        <td>: $Info->hsc_roll </td>
        
        </tr><tr>
        
        <td>SSC GPA</td>       
        <td>: $Info->ssc_gpa</td>
        
         <td>HSC GPA </td>      
        <td>: $Info->hsc_gpa </td>
            
        </tr><tr>
        
        <td>SSC Board Name</td>       
        <td>: $Info->SSCBoardName</td>
        
         <td>HSC Board Name </td>      
        <td>: $Info->HSCBoardName </td>
                
        </tr>
        
        </table>
EOD;

//$pdf->MultiCell(100, 5,$body1, 1, 'L', 1, 0, '', '', true);
$pdf->writeHTMLCell(100, 0, '', '', $body1, 0, 1, 0, true, 'J', true);
$pdf->writeHTMLCell(180, 0, '', '', $body2, 0, 1, 0, true, 'J', true);
$pdf->writeHTMLCell(180, 0, '', '', $body3, 0, 1, 0, true, 'J', true);

// move pointer to last page
$pdf->lastPage();

// ---------------------------------------------------------
ob_clean();
//Close and output PDF document
$pdf->Output($Info->RegNo, 'I');

//============================================================+
// END OF FILE
//============================================================+
