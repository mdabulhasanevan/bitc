<?php

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Evan Hasan');
$pdf->SetTitle('Testimonial');
$pdf->SetSubject('Testimonial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');


// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);


//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------
// set font
$pdf->SetFont('times', '', 13);



// add a page
$pdf->AddPage('L', 'Letter');

// set cell padding
$pdf->setCellPaddings(1, 1, 1, 1);

// set cell margins
$pdf->setCellMargins(15, 2, 15, 2);

// set color for background
$pdf->SetFillColor(255, 255, 255);


$title = <<<EOD
       
         
   <br><br><br><br> <br><br><br><br><br><br><br>
          <p>This is to certify that <b>$Info->FullName </b> the $Info->GenderStatus3 of <br>
         <b>$Info->FatherName </b>& <b> $Info->MotherName </b> </p>
             
EOD;

$smallGender = strtolower($Info->GenderStatus);
$smallGender2 = strtolower($Info->GenderStatus2);

$body = <<<EOD
    <p>was a student of the <b>$Info->FacultyName</b> Department in this institute. $Info->GenderStatus passed $Info->FacultyName (Hon's) degree $Info->Major in the year 
   $Info->PassedYear under the National University, Gazipur, obtain CGPA $Info->LastCGPA on a scale of 4.00, held in the year $Info->ExamYear.
   $Info->GenderStatus2 bearing Registration No. is $Info->RegNo and Session $Info->SessionName. <br>
       <br>So far I know  $smallGender is of moral character and did not take part in any activity subversive of the institute and the state.
    
   <br><br>I wish $smallGender2 every success in life.
   
EOD;


$pdf->writeHTMLCell(0, 0, '', '', $title, 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, 0, '', '', $body, 0, 1, 0, true, 'J', true);


// move pointer to last page
$pdf->lastPage();

// ---------------------------------------------------------
ob_clean();
//Close and output PDF document
$pdf->Output('Testimonial.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
