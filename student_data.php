<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Student Elective Data</title>
</head>

<body>
<h2 style="text-align:center; background:#999">Elective Information</h2>
<?php 
		
		global $id;
		//global $result_qr1;
		
		$conn=mysql_connect("localhost","root","");
		mysql_select_db("Elective_Data",$conn);
		
		if(isset($_GET['submit']))
		{
			$id = mysql_real_escape_string($_GET['student_input']);
		}
		
		$humanities = "HSS|HUM|GS";
		$q5=mysql_query("select * from student_elective_data where ID='$id'");
		$result3 = mysql_fetch_array($q5);
		if(!empty($result3))
		{
			
			$name=$result3['Name'];
	
			$branch_code = substr($id,4,4);
		
	?>
<?php
			$open=0;
			$humanities=0;
			$disciplinary=0;
			$disciplinary_msc=0;
			$max_desc_second=0;
			$is_dual=0;
			$unitflag=0;
			$humanities_electives = array("BITS F385");
			$projcount=0;
			
			/*
			$CHEM = array();
			$CHE = array();
			$ECON = array();
			$EEE = array("BITS F415","CS F342","CS F213","CS F372");
			$ME = array("ECON F411");
			$CS = array("MATH F421","MATH F231","BITS F311","BITS F312","BITS F343","BITS F364","BITS F386","BITS F463","BITS F464","BITS F465","BITS F466","IS F462","IS F341","IS F311");
			$INSTR = array("BITS F312","BITS F415","CS F213","CS F342","CS F372","EEE F345","EEE F346","EEE F422","EEE F426","EEE F431","EEE F433","EEE F434","EEE F435","EEE F472");
			$BIO = array ("MATH F212 ","CHEM F212","CHEM F213");
			$MATH = array("BITS F343","BITS F463","CS F364");
			$PHY = array("BITS F316","BITS F386");
			$IS = array("BITS F311","BITS F312","BITS F343","BITS F364","BITS F386","BITS F463","BITS F464","BITS F465","BITS F466","CS F314","CS F364","CS F401","CS F407","CS F413","CS F415","CS F422","CS F424","CS F441","CS F446","MATH C441","MATH F231","MATH F421");
			$PROJ = array("BIO F266" , "BIO F366" ,"BIO F367","BIO F377","BITS F381","BITS F383","CHE F266","CHE F366","CHE F367","CHE F376","CHE F377","CHEM F266","CHEM F366","CHEM F367","CHEM F376","CHEM F377","CS F266","CS F366","CS F367","CS F376","CS F377","ECON F266","ECON F366","ECON F367","ECON F376","ECON F377","EEE F266","EEE F366","EEE F367","EEE F376","EEE F377","FIN F266","FIN F366","FIN F367","FIN F376","FIN F377","GS F266","GS F366","GS F367","GS F376","GS F377","HSS F266","INSTR F266","INSTR F366","INSTR F367","INSTR F376","INSTR F377","IS F266","IS F366","IS F367","IS F376","IS F377","MATH F266","MATH F366","MATH F367","MATH F376","MATH F377","ME F266","ME F366","ME F367","ME F376","ME F377","MF F266","MF F366","MF F367","MF F376","MF F377","PHY F366","PHY F367","PHY F376","PHY F377");
			*/
			
			$maxfordual = 0;
			$branch = substr($id,4,2);
			$branch2 = substr($id,6,2);
			global $branch_code;
			$branch_code = substr($id,4,4);
			$MscBranch;
			
			$disarray = array();
			$openarray = array(); 
			$humarray = array();
			$dismscarray = array();

			$hum_code_array = array();
			$dis_code_array = array();
			$open_code_array = array();
			$dismsc_code_array = array();
	
			$qr1=mysql_query("select * FROM max_number_elective where branch_code='$branch_code'");//to get max values from database
			$result_qr1=mysql_fetch_array($qr1);
			
			switch($branch2)
			{
					case "a1":
					case "A1":  $is_dual=1;
								$max_desc_second=5;
								$MscBranch="CHE";
								break;
					case "a3":
					case "A3": 	$is_dual=1;
								$max_desc_second=4;
								$MscBranch="EEE";
								break;
					case "a4":			
					case "A4":  $is_dual=1;	
								$max_desc_second=4;
								$MscBranch="ME";
								break;
					case "a7":
					case "A7":  $is_dual=1;
								$max_desc_second=4;
								$MscBranch="CS";
								break;
					case "a8":			
					case "A8": 	$is_dual=1;
								$max_desc_second=4;
								$MscBranch="INSTR";
								break;
					default:	break;
			}
			
			switch($branch)
			{
					case "a1":
					case "A1":  $max_desc_second=5;
								$MscBranch="CHE";
								break;
					case "a3":
					case "A3":  $max_desc_second=4;
								$MscBranch="EEE";
								break;	
					case "a4":		
					case "A4":  $max_desc_second=4;
								$MscBranch="ME";
								break;
					case "a7":
					case "A7":  $max_desc_second=4;
								$MscBranch="CS";
								break;
					case "a8":
					case "A8":  $max_desc_second=4;
								$MscBranch="INSTR";
								break;
					case "c6":
					case "C6":	$max_desc_second=4;
								$MscBranch="IS";
								break;
					default:	break;
			}
			switch($branch)
			{
				case "a1":
				case "A1":	calculate_electives("CHE",$result_qr1['discipline_elective'],$result_qr1['humanities_elective']);
							break;
				case "a3":
				case "A3":	calculate_electives("EEE",$result_qr1['discipline_elective'],$result_qr1['humanities_elective']);
							break;
				case "a4":			
				case "A4":	calculate_electives("ME",$result_qr1['discipline_elective'],$result_qr1['humanities_elective']);
							break;
				case "a7":			
				case "A7":	calculate_electives("CS",$result_qr1['discipline_elective'],$result_qr1['humanities_elective']);
							break;
				case "a8":
				case "A8":  calculate_electives("INSTR",$result_qr1['discipline_elective'],$result_qr1['humanities_elective']);
							break;
				case "b1":
				case "B1":	$maxfordual = 5;
							if($branch2!="PS" & $branch2!="ps")
							{
								calculate_electives_duals("BIO",$result_qr1['first_discipline'],$MscBranch,$result_qr1['second_discipline'],$result_qr1['humanities_elective']);
								break;
							}
							else
								break;
				case "b2":
				case "B2":	$maxfordual = 4;
							if($branch2!="PS" & $branch2!="ps")
							{
								calculate_electives_duals("CHEM",$result_qr1['first_discipline'],$MscBranch,$result_qr1['second_discipline'],$result_qr1['humanities_elective']);
								break;
							}
							else
								break;
				case "b3":
				case "B3":	$maxfordual = 6;
							if($branch2!="PS" & $branch2!="ps")
							{
								calculate_electives_duals("ECON",$result_qr1['first_discipline'],$MscBranch,$result_qr1['second_discipline'],$result_qr1['humanities_elective']);
								break;
							}
							else
								break;
				case "b4":
				case "B4":	$maxfordual = 5;
							if($branch2!="PS" & $branch2!="ps")
							{
								calculate_electives_duals("MATH",$result_qr1['first_discipline'],$MscBranch,$result_qr1['second_discipline'],$result_qr1['humanities_elective']);
								break;
							}
							else
								break;
				case "b5":
				case "B5":	
							if($branch2=="A8" or $branch2== "a8")
							{
								$maxfordual = 4;
								calculate_electives_duals("PHY",$result_qr1['first_discipline'],$MscBranch,$result_qr1['second_discipline'],$result_qr1['humanities_elective']);
								break;
							}
							else if($branch2!="PS" & $branch2!="ps")
							{
								$maxfordual = 5;
								calculate_electives_duals("PHY",$result_qr1['first_discipline'],$MscBranch,$result_qr1['second_discipline'],$result_qr1['humanities_elective']);
								break;
							}
							else
								break;
				case "c6":
				case "C6":	calculate_electives("IS",$result_qr1['discipline_elective'],$result_qr1['humanities_elective']);
							break;
				default:	break;   
			}	
		?>
		<h2 style="text-align:center; text-decoration:underline; color:#099"><?php echo "Welcome"." ".$name ?></h2>
		<h2 style="text-align:center; text-decoration:underline; color:#009">Type of elective and the number of courses taken</h2>
		<h4 style="text-align:center; color:#30F"><?php if($is_dual) echo "*Numbers displayed as: No. of Msc electives + No. of second degree electives"; ?></h4>
		<?php
			
			echo "<table border='1' cellpadding=5 align=center>";
			echo "  <tr>";
			echo "	<th bgcolor=#CCCCCC> Type of Elective </th>";
			echo "	<th bgcolor=#CCCCCC> Number of courses taken </th>";
			if($is_dual)
			{
				echo "<th bgcolor=#CCCCCC>Course Code(MSc)</th>";
				echo "<th bgcolor=#CCCCCC>Course Code(Second Degree)</th>";	
			}
			else
				echo "	<th bgcolor=#CCCCCC> Elective Course Code</th>";
			echo "  </tr>";
			echo "  <tr>";
			echo "	<th>Disciplinary</th>";
			echo "	<td>";
			if(strcasecmp($branch2,"PS"))
				echo $disciplinary_msc." + ".$disciplinary;
			else
			{
				echo $disciplinary;
			}
			echo "	</td>";
			
			if(!$is_dual)
			{
				echo "	<td>";
					if(count($disarray)==0)	echo " ";
					else 
					{
						for($i=0;$i<count($disarray);$i++)
						{
							if($i<count($disarray)-1)
								echo ucfirst(strtolower($disarray[$i])).", ";
							else
								echo ucfirst(strtolower($disarray[$i]))." ";
						}	
					}
				echo "	</td>";
			}
			else
			{
				echo "	<td>";
					if(count($dismscarray)==0)	echo " ";
					else 
					{
						for($i=0;$i<count($dismscarray);$i++)
						{
							if($i<count($dismscarray)-1)
								echo ucfirst(strtolower($dismscarray[$i])).", ";
							else
								echo ucfirst(strtolower($dismscarray[$i]))." ";
						}	
					}
				echo "	</td>";
				echo "	<td>";
					if(count($disarray)==0)	echo " ";
					else 
					{
						for($i=0;$i<count($disarray);$i++)
						{
							if($i<count($disarray)-1)
								echo ucfirst(strtolower($disarray[$i])).", ";
							else
								echo ucfirst(strtolower($disarray[$i]))." ";
						}	
					}
				echo "	</td>";
			}
			echo " 	</tr>";
			echo "  <tr>";
			echo "	<th>Open</th>";
			echo "	<td>";
			echo 	$open;
			echo "	</td>";
			echo "	<td>";
				if(count($openarray)==0)	echo " ";
				else 
				{
					for($i=0;$i<count($openarray);$i++)
					{
						if($i<count($disarray)-1)
							echo ucfirst(strtolower($openarray[$i])).", ";
						else
							echo ucfirst(strtolower($openarray[$i]))." ";
					}	
				}
			echo "	</td>";
			echo " 	</tr>";
			echo "  <tr>";
			echo "	<th>Humanities</th>";
			echo "	<td>";
			echo $humanities;
			echo "	</td>";
			echo "	<td>";
				if(count($humarray)==0)	echo " ";
				else 
				{
					for($i=0;$i<count($humarray);$i++)
					{
						if($i<count($humarray)-1)
							echo ucfirst(strtolower($humarray[$i])).", ";
						else
							echo ucfirst(strtolower($humarray[$i]))." ";
					}	
				}
			echo "	</td>";
			echo " 	</tr>";
			echo " 	<tr>";
			echo "	<th>Projects</th>";
			
			if($projcount>3)
			{
				echo "	<td bgcolor=#FF6633>";
				echo $projcount;
				echo "  </td>";
			}
			else
			{
				echo "	<td>";
				echo $projcount;
				echo "  </td>";	
			}
			echo "	<td></td>";
			echo "	</tr>";
			echo "	</table>";
		?>
		
		<h2 style="text-align:center; text-decoration:underline; color:#009">Minimum Number of Electives Remaining</h2>
		<table border='1' cellpadding=5 align="center">
		  <tr>
			<th bgcolor="#CCCCCC">Type of Elective</th>
			<th bgcolor="#CCCCCC">Minimum Electives Remaining</th>
		  </tr>
		  <tr>
			<th>Disciplinary</th>
			<td><?php 
					if(strcasecmp($branch2,"PS")) 	
						echo ($result_qr1['first_discipline']-$disciplinary_msc)."+".($result_qr1['second_discipline']-$disciplinary) ;//echo $disciplinary_msc."+".$disciplinary;
						else
						{
							echo $result_qr1['discipline_elective']-$disciplinary;
						}
				?>
			</td>
		  </tr>
		  <tr>
			<th>Open</th>
			<td><?php   if($branch2!="PS" & $branch2!="ps")
						echo "-";
						
						else
							echo $result_qr1['open_elective']-$open;
								
				?></td>
		  </tr>
		  <tr>
			<th>Humanities</th>
			<td><?php echo $result_qr1['humanities_elective']-$humanities;?></td>
		  </tr>
		  
		</table>
		
		<?php
			if($unitflag)
				echo "<h3 style='color:#F00;text-align:center'>You have taken atleast one elective with less than 3 units.</h3>";

			echo "<h3 style='color:#00F;text-align:left; padding-left:150px;'>";
			echo "<ul>";
			echo "<li> If you have done both POE and POM, then you can subtract one elective from your open elective count as its not accounted for.</li>";
			echo "<li> If you have dropped any course this semester, it will still show in the list, so you can remove that elective and count.</li>";
			echo "</ul>";
			echo "</h3>";
		?>
		<?php
			$conn=mysql_connect("localhost","root","");
			mysql_select_db("Elective_Data",$conn);
	
		}
		else
		{
			echo "<h2>Incorrect ID, re-enter ID again.</h2>";
		}
		
		function calculate_electives($course_code,$max_disc,$max_hum)
			{   
				global $open;
				global $humanities;
				global $disciplinary;
				global $id;
				global $projcount;
				global $unitflag;
				global $disarray ;
				global $humarray ;
				global $openarray;
				global $dis_code_array ;
				global $hum_code_array ;
				global $open_code_array;
				global $widrawn_count;
				global $MscBranch;
	
				global $humanities_electives;
				$widrawn_count=0;
				global $CHEM,$CHE,$ECON,$EEE,$INSTR,$ME,$CS,$INSTR,$BIO,$MATH,$PHY,$IS,$PROJ;
				
				$query = mysql_query("SELECT * FROM Student_Elective_Data WHERE ID = '$id'");
				$query2 = mysql_query("SELECT COUNT(*) FROM Student_Elective_Data WHERE ID = '$id'");
				$result2 = mysql_fetch_array($query2);
				
				$reduce = 0;
			   
				while($result=mysql_fetch_array($query))
				{
					$check_flag=0;
					$course_number = $result['Subject_code']." ".$result['Catalog_no'];
					
					$subject_code = $result['Subject_code'];

					$course_name = $result['Subject'];
					
					$q1 = mysql_query("SELECT * FROM elective_course WHERE branch='HUM' AND course_code='$course_number'");
					$r1 = mysql_num_rows($q1);
					
					$q2 = mysql_query("SELECT * FROM elective_course WHERE branch='PROJ' AND course_code='$course_number'");
					$r2 = mysql_num_rows($q2);
					$r4 = mysql_fetch_array($q2);
					$proj_course_code = explode(" ",$r4['course_code']);
					
					$q3 = mysql_query("SELECT * FROM elective_course WHERE branch='$MscBranch' AND course_code='$course_number'");
					$r3 = mysql_num_rows($q3);
		
					if($result['Grade']=='W'||$result['Grade']=='RC'||$result['Grade']=='NC'||$result['Grade']=='I'||$result['Grade']=='GA')	
					{
						$widrawn_count++;
						continue;
					}
					if(($result['Subject_code']=="HSS" || $result['Subject_code']=="HUM" || $result['Subject_code']=="GS" || $r1>0))
					{
						//array_push($hum_code_array,$course_number);
						if(!in_array($course_number,$hum_code_array))
						{
							array_push($hum_code_array,$course_number);
							array_push($humarray, $course_name);
							$humanities++;
						}
						else
							$reduce++;
						$check_flag=1;
					}	
					else if($r3 || $proj_course_code[0]==$MscBranch)
					{
						//array_push($dis_code_array,$course_number);
						if(!in_array($course_number, $dis_code_array))
						{
							array_push($dis_code_array,$course_number);
							array_push($disarray,$course_name);
							$disciplinary++;
						}
						else
							$reduce++;
						$check_flag=1;
					}	
					
					if($check_flag==0)
					{
						//array_push($open_code_array,$course_number);
						if(!in_array($course_number, $open_code_array))
						{
							array_push($open_code_array,$course_number);
							array_push($openarray,$course_name);
						}
						else
							$reduce++;
					}
						
					if($r2)
					 {
						 $projcount++;
					 }
						 
					if($result['Units']<3) $unitflag=1;
				}
				if($humanities>$max_hum)
				{
					$humanities = $max_hum;
					$count=count($humarray);
					for($j=$count-1;$j>=$max_hum;$j--)
					{
						array_push($openarray,$humarray[count($humarray)-1]);	
						array_pop($humarray);
					}
				}
				
				if($disciplinary>$max_disc)
				{
					$disciplinary = $max_disc;
					$count=count($disarray);
					for($j=$count-1;$j>=$max_disc;$j--)
					{
						array_push($openarray,$disarray[count($disarray)-1]);	
						array_pop($disarray);
					}
				}
				
				$open = $result2[0]-$humanities-$disciplinary-$widrawn_count-$reduce;
				
			}
		
		function calculate_electives_duals($course_code,$max_disc_msc,$course_code_second,$max_disc_second,$max_hum)
			{
				global $open;
				global $humanities;
				global $disciplinary_msc;
				global $disciplinary;
				global $id;
				global $projcount;
				global $PROJ;
				global $humanities_electives;
				global $CHEM,$CHE,$ECON,$EEE,$INSTR,$ME,$CS,$INSTR,$BIO,$MATH,$PHY,$IS;
				global $disarray ;
				global $dismscarray;
				global $humarray ;
				global $openarray;
				global $dis_code_array ;
				global $dismsc_code_array;
				global $hum_code_array ;
				global $open_code_array;
				global $widrawn_count;
				global $MscBranch;
					
				$query = mysql_query("SELECT * FROM student_elective_data WHERE ID = '$id'");
				$query2 = mysql_query("SELECT COUNT(*) FROM student_elective_data WHERE ID = '$id'");
				$widrawn_count=0;
	
				$result2 = mysql_fetch_array($query2);
				
				$humanities_electives = array("BITS F385");

				$reduce=0;
				
				while($result=mysql_fetch_array($query))
				{
					$check_flag=0;
					$course_number = $result['Subject_code']." ".$result['Catalog_no'];
					
					$subject_code = $result['Subject_code'];

					$course_name = $result['Subject'];
					
					$q1 = mysql_query("SELECT * FROM elective_course WHERE branch='HUM' AND course_code='$course_number'");
					$r1 = mysql_num_rows($q1);
					
					$q2 = mysql_query("SELECT * FROM elective_course WHERE branch='PROJ' AND course_code='$course_number'");
					$r2 = mysql_num_rows($q2);
					
					$q3 = mysql_query("SELECT * FROM elective_course WHERE branch='$subject_code' AND course_code='$course_number'");
					$r3 = mysql_num_rows($q3);
	
					//$q4 = mysql_query("SELECT * FROM elective_course WHERE branch='$subject_code' AND course_code='$course_number'");
					//$r4 = mysql_num_rows($q4);
	
					$r5 = mysql_fetch_array($q2);
					$proj_course_code = explode(" ",$r5['course_code']);

					//$proj_course_code = trim(substr($r5['course_code'],0,2));
					
					if($result['Grade']=='W'||$result['Grade']=='RC'||$result['Grade']=='NC'||$result['Grade']=='I'||$result['Grade']=='GA')	
					{
						$widrawn_count++;
						continue;
					}
	
					if(($result['Subject_code']=="HSS" || $result['Subject_code']=="HUM" || $result['Subject_code']=="GS" || $r1>0))
					{
						//array_push($hum_code_array,$course_number);
						if(!in_array($course_number, $hum_code_array))
						{
							array_push($hum_code_array,$course_number);
							array_push($humarray,$course_name);
							$humanities++;
						}	
						else
							$reduce++;
						$check_flag=1;			
					}
					else if(($r3&&$course_code==$subject_code)|| $proj_course_code[0]==$course_code)
					{
						//array_push($dismsc_code_array,$course_number);
						if(!in_array($course_number, $dismsc_code_array))
						{
							array_push($dismsc_code_array,$course_number);
							array_push($dismscarray,$course_name);
							$disciplinary_msc++;
						}
						else
							$reduce++;
						$check_flag=1;
					}
					else if(($r3&&$course_code_second==$subject_code)|| $proj_course_code[0]==$MscBranch)
					{
						//array_push($dis_code_array,$course_number);
						if(!in_array($course_number, $dis_code_array))
						{
							array_push($dis_code_array,$course_number);
							array_push($disarray,$course_name);
							$disciplinary++;
						}
						else
							$reduce++;
						$check_flag=1;
					}
					if($check_flag==0)
					{
						//array_push($open_code_array,$course_number);
						if(!in_array($course_number, $open_code_array))
						{
							array_push($open_code_array,$course_number);
							array_push($openarray,$course_name);
						}
						else
							$reduce++;
					}
						
					if($r2)
					 {
						 $projcount++;
					 }
					
					
					if($result['Units']<3) $unitflag=1;
				}
				
				
				if($humanities>$max_hum)
				{
					$humanities = $max_hum;
					$count=count($humarray);
					for($j=$count-1;$j>=3;$j--)
					{
						array_push($openarray,$humarray[count($humarray)-1]);	
						array_pop($humarray);
					}
				}
					
				if($disciplinary>$max_disc_msc)
				{
					$disciplinary_msc = $max_disc_msc;
					$count=count($dismscarray);
					for($j=$count-1;$j>=$max_disc_msc;$j--)
					{
						array_push($openarray,$dismscarray[count($dismscarray)-1]);	
						array_pop($dismscarray);
					}
				}
					
				if($disciplinary>$max_disc_second)
				{
					$disciplinary = $max_disc_second;
					$count=count($disarray);
					for($j=$count-1;$j>=$max_disc_second;$j--)
					{
						array_push($openarray,$disarray[count($disarray)-1]);	
						array_pop($disarray);
					}
				}	
				
				$open = $result2[0]-($humanities+$disciplinary_msc+$disciplinary)-$widrawn_count-$reduce;
			}
	?>
</body>
</html>