<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
	
	$conn=mysql_connect("localhost","root","");
	mysql_select_db("Elective_Data",$conn);
		
	if(isset($_GET['add']))
	{
		$elective_branch = $_GET['branch'];
		$elective_coursecode = $_GET['coursecode'];
	}

	$query = mysql_query("SELECT * FROM elective_course where branch='$elective_branch' AND course_code='$elective_coursecode'");
	
	$branch = strtoupper($elective_branch);
	$course_code = strtoupper($elective_coursecode);
	
	if(!mysql_num_rows($query))
		$q1 = mysql_query("INSERT INTO elective_course 
					   		SET branch='$branch',
							course_code='$course_code'");
							
	header("location:edit.php");							
	
?>

</body>
</html>