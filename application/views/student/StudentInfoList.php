<?php

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Evan Hasan');
$pdf->SetTitle('Testimonial');
$pdf->SetSubject('Testimonial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData('Logo.jpg', 20, 'Barisal Information Technology College BITC', '');

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
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', '', 14);

// add a page
$pdf->AddPage();

// set cell padding
$pdf->setCellPaddings(1, 1, 1, 1);

// set cell margins
$pdf->setCellMargins(1, 1, 1, 1);

// set color for background
$pdf->SetFillColor(255, 255, 255);

$title= <<<EOD
       <br><br><br><br><br> <h3>To Whome It May Concern</h3> 
EOD;
$body= <<<EOD
        <p><b>$Info->FullName </b> 
            S/D of <b>$Info->FatherName </b> And 
            Mother's Name <b>$Info->MotherName </b> 
            Faculty is <b>$Info->FacultyName </b>
            Session <b>$Info->SessionName </b> 
            StudentID <b>$Info->StudentInsID </b>
            to apply for a transfer of my job posting to the city of ............. I am having some family issues which I have to attend to more frequently these days. It would be highly convenient for me to deal with them if I were to be resided at the city of .............. Hence, I kindly request you to do the needful in this regard. This will be of mutual benefit both to me and the Company as I would not be seeking any additional leaves which I am taking more frequently these days due to the family issues. I hope you would consider my request favorably.
Therefore, I would like to request you that my job posting can kindly be relocated to any of the branch office at the (city), which would make my personal and work life much easier to maintain. It will also help me in focused concentration at work and ultimately resulting in better performance.
</p>
EOD;

$signature= <<<EOD
       <br><br><br><br><br> <h5>Principal's Signature</h5> 
EOD;
$pdf->writeHTMLCell(0, 0, '', '', $title, 0, 1, 0, true, 'C',true);
$pdf->writeHTMLCell(0, 0, '', '', $body, 0, 1, 0, true, 'J',true);
$pdf->writeHTMLCell(0, 0, '', '', $signature, 0, 1, 0, true, 'R',true);      


// move pointer to last page
$pdf->lastPage();

// ---------------------------------------------------------
ob_clean();
//Close and output PDF document
$pdf->Output('Testimonial.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
