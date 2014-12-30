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
		
	if(isset($_GET['delete']))
	{
		//$elective_branch = $_GET['branch'];
		$branch = $_GET['delete_branch'];
		$elective_coursecode = $_GET['coursecode'];
	}
	
	if(!mysql_num_rows($query))
		$q1 = mysql_query("DELETE FROM elective_course WHERE branch='$branch' AND course_code='$elective_coursecode'");
							
	header("location:edit.php");							
	
?>

</body>
</html>