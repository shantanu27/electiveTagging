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

	if(isset($_GET['done']))
	{
		$branch = $_GET['send_branch'];
		$disEL = $_GET['disEL'];
		$openEL = $_GET['openEL'];
		$humEL = $_GET['humEL'];
		$branch=strtoupper($branch);
		echo $disEL." ".$openEL." ".$humEL." ".$branch;
		$q1=mysql_query("UPDATE max_number_elective SET  discipline_elective='$disEL', open_elective='$openEL',humanities_elective='$humEL' WHERE branch_code='$branch' ");
		
		if($q1)	header("location:edit.php");
		else echo "ERROR in editing data!!";

	}

	else if(isset($_GET['doneMsc']))
	{
		echo "hi bitch";
		$branch = $_GET['send_branch'];
		$firstDis = $_GET['firstDis'];
		$secondDis = $_GET['secondDis'];
		$humELmsc = $_GET['humELmsc'];
		$q2=mysql_query("UPDATE max_number_elective SET first_discipline='$firstDis',second_discipline='$secondDis',humanities_elective='$humELmsc' WHERE branch_code='$branch' ");
		if($q2)	header("location:edit.php");
		else echo "ERROR in editing data!!";
	}

?>

</body>
</html>	

