<html>
<?php
	ini_set('memory_limit', '-1');
	$conn=mysql_connect("localhost","root","");
	mysql_select_db("Elective_Data",$conn);

	require_once 'PHPExcel/IOFactory.php';
	require_once 'PHPExcel.php';
	
	if ($_FILES["file"]["error"] > 0)
  	{
  		die("Error: " . $_FILES["file"]["error"] . "<br>");
  	}
	else
  	{
		$tmp = $_FILES["file"]["tmp_name"];
		move_uploaded_file($tmp, "uploads/".$_FILES["file"]["name"]);
		$filename = "uploads/".$_FILES["file"]["name"];
		echo $filename;
	}
	
	$campus_id='';
	$name = '';
	$academic_career ='';
	$semester ='';
	$description ='';
	$course_id ='';
	$descr ='';
	$subject ='';
	$catalog_no ='';
	$unit_taken = '';
	$course_grade ='';
	$ifelective ='';	

	$obj = PHPExcel_IOFactory::load($filename);
	
	$sheet = $obj->getSheet(0);
	
	$row = 0;
	
	$maxrows = $sheet->getHighestRow();
	
	$headers = array("Campus ID", "Name", "Academic Career", "Semester","Description", "Course ID", "Descr", "Subject", "Catalog No.", "Unit Taken","Course Grade");	
	$obj_w = new PHPExcel();
	$obj_w->getActiveSheet()->setTitle('Student Elective Data');
	$sh_w = $obj_w->getActiveSheet();
	$obj_w->setActiveSheetIndex(0);
	
	for ($i=0;$i<11;$i++) 
	{
		$sh_w->setCellValueByColumnAndRow($i, 1, $headers[$i]);
	}
	
	$row_write = 2;
	
	for($row=1; $row<=$maxrows ; $row++)
	{
		$ifelective = $sheet->getCellByColumnAndRow(11,$row)->getValue();
		
		if(trim($ifelective)=="EL")
		{
			$campus_id = $sheet->getCellByColumnAndRow(0,$row)->getValue();
			$name = $sheet->getCellByColumnAndRow(1,$row)->getValue();
			$academic_career = $sheet->getCellByColumnAndRow(2,$row)->getValue();
			$semester = $sheet->getCellByColumnAndRow(3,$row)->getValue();
			$description = $sheet->getCellByColumnAndRow(4,$row)->getValue();
			$course_id = $sheet->getCellByColumnAndRow(5,$row)->getValue();
			$descr = $sheet->getCellByColumnAndRow(6,$row)->getValue();
			$subject = $sheet->getCellByColumnAndRow(7,$row)->getValue();
			$catalog_no = $sheet->getCellByColumnAndRow(8,$row)->getValue();
			$unit_taken = $sheet->getCellByColumnAndRow(9,$row)->getValue();
			$course_grade = $sheet->getCellByColumnAndRow(10,$row)->getValue();
			
			$sh_w->setCellValueByColumnAndRow(0, $row_write, $campus_id);
			$sh_w->setCellValueByColumnAndRow(1, $row_write, $name);
			$sh_w->setCellValueByColumnAndRow(2, $row_write, $academic_career);
			$sh_w->setCellValueByColumnAndRow(3, $row_write, $semester);
			$sh_w->setCellValueByColumnAndRow(4, $row_write, $description);
			$sh_w->setCellValueByColumnAndRow(5, $row_write, $course_id);
			$sh_w->setCellValueByColumnAndRow(6, $row_write, $descr);
			$sh_w->setCellValueByColumnAndRow(7, $row_write, $subject);
			$sh_w->setCellValueByColumnAndRow(8, $row_write, $catalog_no);
			$sh_w->setCellValueByColumnAndRow(9, $row_write, $unit_taken);
			$sh_w->setCellValueByColumnAndRow(10, $row_write, $course_grade);
			
			
			$query2 = mysql_query("SELECT * FROM Student_Elective_Data WHERE ID = '$campus_id' AND
									Name = '$name' AND
									Subject = '$descr' AND
									Subject_code = '$subject' AND
									Catalog_no = '$catalog_no' AND
									Units = '$unit_taken' AND
									Grade = '$course_grade'");
			$result = mysql_num_rows($query2);	
			if($result)
			{
				$row_write++;
				continue;	
			}
			else
			{
				$query=mysql_query("INSERT INTO Student_Elective_Data
									SET
									ID = '$campus_id',
									Name = '$name',
									Subject = '$descr',
									Subject_code = '$subject',
									Catalog_no = '$catalog_no',
									Units = '$unit_taken',
									Grade = '$course_grade'");
					
				$row_write++;
			}	
				
		}
		
	}
	
	$objWriter = PHPExcel_IOFactory::createWriter($obj_w,'Excel2007');	
	$objWriter->save('Student Elective Data.xlsx');
?>
<h1>File with student elective data generated!</h1>
</html>