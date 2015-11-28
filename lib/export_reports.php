<?php
	
require_once('../config.php');
require_once($CFG->libdir.'/excellib.class.php');
require_once($CFG->libdir . '/csvlib.class.php');
require_once($CFG->libdir . '/pdflib.php');       

class Export_Reports{

	

	
		/*
		  $fields should be in array() format
		  $data should be in array() or Object format
		*/
		function report_download_csv($fields,$data,$reportname='reportincsv'){

		    $filename = clean_filename($reportname);

		    $csvexport = new csv_export_writer();
		    $csvexport->set_filename($filename);
		    $csvexport->add_data($fields);
			foreach ($data as $eachrow) {
			    $csvexport->add_data($eachrow);
			}
		    
		    $csvexport->download_file();
		}






		/*
		  $fields should be in array() format
		  $data should be in array() or Object format
		*/
		function report_download_xls($fields,$data,$reportname='reportinxls'){

		    $workbook = new MoodleExcelWorkbook('-');
		    $workbook->send($reportname);

		    $worksheet = array();

		    $worksheet[0] = $workbook->add_worksheet('');
		    $col = 0;
		    foreach ($fields as $fieldname) {
			$worksheet[0]->write(0, $col, $fieldname);
			$col++;
		    }

		    $row = 1;
		    foreach ($data as $eachrow) {
		
			$col = 0;
			foreach ($eachrow as $key=>$value) {
			    $worksheet[0]->write($row, $col, $value);
			    $col++;
			}
			$row++;
		    }

		    $workbook->close();
		  die;  

		}

		/*
		  $fields should be in array() format
		  $data should be in array() or Object format
		*/

/*
we need to override the followning method in pdflib.php file 
to set logo on pdf file
ob_clean(); need to be copied into output method in pdflib.php
//Page header
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'kmit.png';
        $this->Image($image_file, 10, 10, 50, '25', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
        $this->Cell(0, 15, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }
*/
		function report_download_pdf($html){

		$doc = new pdf;
		//$doc->Header();
		$doc->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, 'Teleparadigm', array(), array());
		$doc->setFooterData(array(0,64,0), array(0,64,128));
		$doc->setPrintHeader(false);
		$doc->setPrintFooter(true);
		// set margins
		$doc->SetMargins(PDF_MARGIN_LEFT, 5, PDF_MARGIN_RIGHT);
		$doc->SetHeaderMargin(PDF_MARGIN_HEADER);
		$doc->SetFooterMargin(PDF_MARGIN_FOOTER);
		$doc->AddPage();	
		$doc->writeHTML($html, true, false, true, false, '');
		$doc->Output();
		die;

		}


}





?>

