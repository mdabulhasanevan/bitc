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
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', '', 13);

// add a page
$pdf->AddPage();

// set cell padding
$pdf->setCellPaddings(1, 1, 1, 1);

// set cell margins
$pdf->setCellMargins(10, 2, 10, 2);

// set color for background
$pdf->SetFillColor(255, 255, 255);

$dateTime=<<<EOD
        <br><br><br><br><br><br>
<p>
   Date: $Info->DateOfPrint   
   </p>         
EOD;
$title= <<<EOD
        
       
          
   <br><br><br><br> 
           <u><span style="font-family:Certificate, Charcoal, sans-serif;">To Whom It May Concern<span></u>
EOD;
$body= <<<EOD
        <p><b>$Info->FullName </b> 
           $Info->GenderStatus3 of <b>$Info->FatherName </b> And 
             <b>$Info->MotherName </b> 
            bearing Examination Registration No: <b>$Info->RegNo </b> and Session: <b>$Info->SessionName </b> 
        is a student of <b>$Info->FacultyName $Info->MajorName </b>has completed 4th year 8th semester.
        The theoretical examination completed during $Info->ExamCompletedFromTo from our institution under the rules and Regulations of “National University”.
         $Info->GenderStatus2 cumulative grade point average (CGPA) up to 7th Semester is  $Info->LastCGPA out of 4.00 point scales.  The final result of <span style=" text-transform: lowercase;"> $Info->GenderStatus2 </span>4 years $Info->FacultyonlyName Program will be published soon.
        </p>
      
        <p>$Info->GenderStatus2 medium of course is in English</p>
            
        <p>I recommend <span style="text-transform: lowercase;">$Info->GenderStatus2 </span> candidature for any job/higher education within or beyond the country. </p>
   <br><br>I wish every success in <span style="text-transform: lowercase;">$Info->GenderStatus2 </span> life.
   
   
EOD;

$signature= <<<EOD
       <br><br><br>
           Thanking you,
<br><br><br><br><br><br>
(Md. Anisur Rahman)
<br>
Principal
<br>
Barisal Information Technology College (BITC) 
EOD;

$pdf->writeHTMLCell(0, 0, '', '', $dateTime, 0, 1, 0, true, 'L',true);

$pdf->writeHTMLCell(0, 0, '', '', $title, 0, 1, 0, true, 'C',true);
$pdf->writeHTMLCell(0, 0, '', '', $body, 0, 1, 0, true, 'J',true);
$pdf->writeHTMLCell(0, 0, '', '', $signature, 0, 1, 0, true, 'L',true);      


// move pointer to last page
$pdf->lastPage();

// ---------------------------------------------------------
ob_clean();
//Close and output PDF document
$pdf->Output('Testimonial.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
