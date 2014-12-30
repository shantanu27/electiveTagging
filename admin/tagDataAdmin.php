<?php
	
	ini_set('memory_limit', '-1');
	$conn=mysql_connect("localhost","root","");
	mysql_select_db("elective_data",$conn);

	require_once 'PHPExcel/IOFactory.php';
	require_once 'PHPExcel.php';

	if ($_FILES["file"]["error"] > 0)
  	{
  		die("Error: " . $_FILES["file"]["error"] . "<br>");
  	}
	else
  	{
		$tmp = $_FILES["file"]["tmp_name"];
		move_uploaded_file($tmp, "Uploads/".$_FILES["file"]["name"]);
		$filename = "Uploads/".$_FILES["file"]["name"];
		$savelocation = "Output/".$_FILES["file"]["name"];
		echo $filename;
	}

	$subject ='';
	$catalog_no ='';
	$Branch;

	$obj = PHPExcel_IOFactory::load($filename);
	$sheet = $obj->getSheet(0);

	$obj_w = new PHPExcel();
	$sh_w = $obj_w->getActiveSheet();
	$obj_w->setActiveSheetIndex(0);
	
	$maxrows = $sheet->getHighestRow();

	$headers = array("Campus ID", "Name", "Academic Career", "Semester","Description", "Course ID", "Descr", "Subject", "Catalog No.", "Unit Taken","Course Grade","Elective Tag");

	for($i=0;$i<count($headers);$i++)
	{
		$sh_w->setCellValueByColumnAndRow($i, 2,$headers[$i]);
	}

	for($row=3; $row<$maxrows ; $row++)
	{

		$ifelective = $sheet->getCellByColumnAndRow(11,$row)->getValue();

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

		$sh_w->setCellValueByColumnAndRow(0, $row, $campus_id);
		$sh_w->setCellValueByColumnAndRow(1, $row, $name);
		$sh_w->setCellValueByColumnAndRow(2, $row, $academic_career);
		$sh_w->setCellValueByColumnAndRow(3, $row, $semester);
		$sh_w->setCellValueByColumnAndRow(4, $row, $description);
		$sh_w->setCellValueByColumnAndRow(5, $row, $course_id);
		$sh_w->setCellValueByColumnAndRow(6, $row, $descr);
		$sh_w->setCellValueByColumnAndRow(7, $row, $subject);
		$sh_w->setCellValueByColumnAndRow(8, $row, $catalog_no);
		$sh_w->setCellValueByColumnAndRow(9, $row, $unit_taken);
		$sh_w->setCellValueByColumnAndRow(10, $row, $course_grade);
		
		if(trim($ifelective)=="EL")
		{
			$subject= $sheet->getCellByColumnAndRow(7,$row)->getValue();
			$catalog_no= $sheet->getCellByColumnAndRow(8,$row)->getValue();
			$course_no=$subject." ".$catalog_no;
			
			$id= $sheet->getCellByColumnAndRow(0,$row)->getValue();
			$code = substr($id,4,4);
			$branch_code1 = substr($id, 4,2);
			$branch_code2 = substr($id, 6,2);

			$Branch2 = '';

        	switch($code)
			{
				case "a1ps":
				case "A1PS":
							$Branch1="CHE";
							break;
				case "a3ps":
				case "A3PS": $Branch1="EEE";
							break;
				case "a4ps":			
				case "A4PS":  
							$Branch1="ME";
							break;
				case "a7ps":
				case "A7PS":  
							$Branch1="CS";
							break;
				case "a8ps":			
				case "A8PS": 	
							$Branch1="INSTR";
							break;
				case "c6ps":
				case "C6PS":	
							$Branch1="IS";
							break;			

				case "b1ps":
				case "B1PS":$Branch1="BIO";
							break;

				case "b2ps":
				case "B2PS":$Branch1="CHEM";
							break;

				case "b3ps":
				case "B3PS":$Branch1="ECON";
							break;

				case "b4ps":
				case "B4PS":$Branch1="MATH";
							break;

				case "b5ps":
				case "B5PS":$Branch1="PHY";
							break;

				case "b1a1":
				case "B1A1":$Branch1="BIO";
							$Branch2="CHE";
							break;
				case "b1a3":
				case "B1A3":$Branch1="BIO";
							$Branch2="EEE";
							break;
				case "b1a4":
				case "B1A4":$Branch1="BIO";
							$Branch2="ME";
							break;

				case "b1a7":
				case "B1A7":$Branch1="BIO";
							$Branch2="CS";
							break;
				case "b1a8":
				case "B1A8":$Branch1="BIO";
							$Branch2="INSTR";
							break;
				
				case "b2a1":
				case "B2A1":$Branch1="CHEM";
							$Branch2="CHE";
							break;
				case "b2a3":
				case "B2A3":$Branch1="CHEM";
							$Branch2="EEE";
							break;
				case "b2a4":
				case "B2A4":$Branch1="CHEM";
							$Branch2="ME";
							break;

				case "b2a7":
				case "B3A7":$Branch1="CHEM";
							$Branch2="CS";
							break;
				case "b2a8":
				case "B3A8":$Branch1="CHEM";
							$Branch2="INSTR";
							break;

				case "b3a1":
				case "B3A1":$Branch1="ECON";
							$Branch2="CHE";
							break;
				case "b3a3":
				case "B3A3":$Branch1="ECON";
							$Branch2="EEE";
							break;
				case "b3a4":
				case "B3A4":$Branch1="ECON";
							$Branch2="ME";
							break;

				case "b3a7":
				case "B3A7":$Branch1="ECON";
							$Branch2="CS";
							break;
				case "b3a8":
				case "B3A8":$Branch1="ECON";
							$Branch2="INSTR";
							break;

				case "b4a1":
				case "B4A1":$Branch1="MATH";
							$Branch2="CHE";
							break;
				case "b4a3":
				case "B4A3":$Branch1="MATH";
							$Branch2="EEE";
							break;
				case "b4a4":
				case "B4A4":$Branch1="MATH";
							$Branch2="ME";
							break;

				case "b4a7":
				case "B4A7":$Branch1="MATH";
							$Branch2="CS";
							break;
				case "b4a8":
				case "B4A8":$Branch1="MATH";
							$Branch2="INSTR";
							break;

				case "b5a1":
				case "B5A1":$Branch1="PHY";
							$Branch2="CHE";
							break;
				case "b5a3":
				case "B5A3":$Branch1="PHY";
							$Branch2="EEE";
							break;
				case "b5a4":
				case "B5A4":$Branch1="PHY";
							$Branch2="ME";
							break;

				case "b5a7":
				case "B5A7":$Branch1="PHY";
							$Branch2="CS";
							break;
				case "b5a8":
				case "B5A8":$Branch1="PHY";
							$Branch2="INSTR";
							break;
							
				default:	break;
			}


			$q1 = mysql_query("SELECT * FROM elective_course WHERE branch='HUM' AND course_code='$course_no'");
			$r1 = mysql_num_rows($q1);
				
			$q2 = mysql_query("SELECT * FROM elective_course WHERE branch='PROJ' AND course_code='$course_no'");
			$result = mysql_fetch_array($q2);
			$r2 = mysql_num_rows($q2);
				
			$q3 = mysql_query("SELECT * FROM elective_course WHERE branch='$Branch1' OR branch='$Branch2' AND course_code='$course_no'");
			$r3 = mysql_num_rows($q3);
			
			$proj_branch = strtok($result['course_code']," ");

			if($r1)
			{
			 	$sh_w->setCellValueByColumnAndRow(12, $row,"HUEL");
			}
			else if(($r2>0)&& ($proj_branch==$Branch1 || $proj_branch==$Branch2 ))
			{	
				if($proj_branch==$Branch1)
					$sh_w->setCellValueByColumnAndRow(12, $row,$branch_code1."EL");
				else if( $proj_branch==$Branch2)
					$sh_w->setCellValueByColumnAndRow(12, $row,$branch_code2."EL");
			}
			else if($r3)
			{
				$sh_w->setCellValueByColumnAndRow(12, $row,$branch_code1."EL");
			}
			else
			{
				$sh_w->setCellValueByColumnAndRow(12, $row,"EL");
			}
		}
	}

	$objWriter = PHPExcel_IOFactory::createWriter($obj_w,'Excel2007');	
	$objWriter->save($savelocation);

?>