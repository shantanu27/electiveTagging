<html>
<?php
	
	$conn=mysql_connect("localhost","root","");
	mysql_select_db("Elective_course",$conn);

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
		$filename = "ELECTIVES TAGGING -5 FEB 14";
		echo $filename;
	}

	$Branch='';
	$course_code='';

	$obj = PHPExcel_IOFactory::load($filename);
	$sheet = $obj->getSheet(2);

	$row=0;
	$maxrows = $sheet->getHighestRow();

	for($row=1; $row<=$maxrows ; $row++)
	{
		$code = $sheet->getCellByColumnAndRow(0,$row)->getValue();

		switch(trim($code))
		{
				case "a1":
				case "A1":
							$Branch="CHEM";
							break;
				case "a3":
				case "A3": 	$Branch="EEE";
							break;
				case "a4":			
				case "A4":  
							$Branch="ME";
							break;
				case "a7":
				case "A7":  
							$Branch="CS";
							break;
				case "a8":			
				case "A8": 	
							$Branch="INSTR";
							break;
				case "c6":
				case "C6":	
							$Branch="IS";
							break;			

				case "b1":
				case "B1":	$Branch="BIO";
							break;

				case "b2":
				case "B2":	$Branch="CHEM";
							break;

				case "b3":
				case "B3":	$Branch="ECON";
							break;

				case "b4":
				case "B4":	$Branch="MATH";
							break;

				case "b5":
				case "B5":	$Branch="PHY";
							break;
							
				default:	break;
		}

		$course_code = $sheet->getCellByColumnAndRow(2,$row)->getValue();

		$query=mysql_query("INSERT into elective_course SET branch='$Branch' ,course_code='$course_code'")		
	}


?>
</html>	