<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Data</title>
</head>
	

<body>
	<h2 style="text-align:center; background:#999"> Add Elective Course</h2>
    <form action="insert.php" method="get" align="center">
    	<select name="branch">
        	<option value="" style="display:none;">Select Branch</option>
            <option value="HUM">Humanities</option>
            <option value="BIO">Biology</option>
            <option value="CHE">Chemical</option>
            <option value="CHEM">Chemistry</option>
            <option value="CS">Computer Science</option>
            <option value="ECON">Economics</option>
            <option value="EEE">EEE</option>
            <option value="INSTR">ENI</option>
            <option value="IS">Information Systems</option>
            <option value="MATH">Maths</option>
            <option value="ME">Mechanical</option>
            <option value="PHY">Physics</option>
            <option value="PROJ">Project</option>
        </select>
        
        &nbsp&nbsp&nbsp&nbsp&nbsp
        
        <b>Enter Course code: [Subject code] [Catalog no.]</b>
        
        &nbsp&nbsp&nbsp&nbsp&nbsp
        
        <input type="text" name="coursecode" size="20" placeholder=" Enter Course Code" />
        <br /><br />	
        <input type="submit" name="add" value="Add" />
    </form>
    
     <h2 style="text-align:center; background:#999"> Delete Elective Course</h2>
   
   		<form action="edit.php" method="get" align="center">
            <select name="branch">
                <option value="" style="display:none;">Select Branch</option>
                <option value="HUM">Humanities</option>
                <option value="BIO">Biology</option>
                <option value="CHE">Chemical</option>
                <option value="CHEM">Chemistry</option>
                <option value="CS">Computer Science</option>
                <option value="ECON">Economics</option>
                <option value="EEE">EEE</option>
                <option value="INSTR">ENI</option>
                <option value="IS">Information Systems</option>
                <option value="MATH">Maths</option>
                <option value="ME">Mechanical</option>
                <option value="PHY">Physics</option>
            </select>
            &nbsp&nbsp&nbsp&nbsp&nbsp
            <input type="submit" name="predelete" value="Go" />
          </form> 
            &nbsp&nbsp&nbsp&nbsp&nbsp
            
            <form action="delete.php" method="get" align="center">
       		<?php
				
				$conn=mysql_connect("localhost","root","");
				mysql_select_db("Elective_Data",$conn);
			
				if(isset($_GET['predelete']))
				{
					$branch = trim($_GET['branch']);
					//echo "<select name='branch_course'>";	
					echo "<input type='hidden' name='delete_branch' value='$branch'>";
					$query = mysql_query("SELECT * FROM elective_course WHERE branch='$branch'");
					
                     //echo "<input type="text" name="branch" size="20" text='".$branch."' />";
                    echo "<input type='text' name='branch' value='";
                    echo "$branch'>";
                    echo "&nbsp&nbsp&nbsp&nbsp&nbsp";
					echo "<select name='coursecode'>";
					echo "<option value='' style='display:none;'>Select Course</option>";
					while($result=mysql_fetch_array($query))
					{
						echo "<option value='".$result['course_code']."'>".$result['course_code']."</option>";
					}
					echo "</select>";
					echo "<input type='submit' name='delete' value='Delete' />";

                   
				}
				
			?>
            <br /><br />
            
            </form>

            <h2 style="text-align:center; background:#999"> Change the Maximum Number of Electives</h2>
            <form action="edit.php" method="get" align="center">
                <select name="branch_code">
                <option value="" style="display:none;">Select Branch</option>
                <option value="a1ps">A1PS</option>
                <option value="a3ps">A3PS</option>
                <option value="a4ps">A4PS</option>
                <option value="a7ps">A7PS</option>
                <option value="a8ps">A8PS</option>
                <option value="c6ps">C6PS</option>

                <option value="b1a1">B1A1</option>
                <option value="b1a3">B1A3</option>
                <option value="b1a4">B1A4</option>
                <option value="b1a7">B1A7</option>
                <option value="b1a8">B1A8</option>

                <option value="b2a1">B2A1</option>
                <option value="b2a3">B2A3</option>
                <option value="b2a4">B2A4</option>
                <option value="b2a7">B2A7</option>
                <option value="b2a8">B2A8</option>

                <option value="b3a1">B3A1</option>
                <option value="b3a3">B3A3</option>
                <option value="b3a4">B3A4</option>
                <option value="b3a7">B3A7</option>
                <option value="b3a8">B3A8</option>

                <option value="b4a1">B4A1</option>
                <option value="b4a3">B4A3</option>
                <option value="b4a4">B4A4</option>
                <option value="b4a7">B4A7</option>
                <option value="b4a8">B4A8</option>

                <option value="b5a1">B5A1</option>
                <option value="b5a3">B5A3</option>
                <option value="b5a4">B5A4</option>
                <option value="b5a7">B5A7</option>
                <option value="b5a8">B5A8</option>
                
                </select>
                &nbsp&nbsp&nbsp&nbsp&nbsp
                <input type="submit" name="change" value="Go" />
            </form> 
                &nbsp&nbsp&nbsp&nbsp&nbsp

             <form action="changeMaxEL.php" method="get" align="center">
                <?php
                        if(isset($_GET['change']))
                        {
                            $branch = trim($_GET['branch_code']);
                            echo "<input type='hidden' name='send_branch' value='$branch'>";
                
                            if($branch=="a1ps"||$branch=="a3ps"||$branch=="a4ps"||$branch=="a7ps"||$branch=="a8ps"||$branch=="c6ps") 
                            {
                                echo "<input type='text' name='disEL' size='20' placeholder='Enter Max Discipline EL' />";
                                echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                                echo "<input type='text' name='openEL' size='20' placeholder='Enter Max Open EL' />";
                                echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                                echo "<input type='text' name='humEL' size='20' placeholder='Enter Max Humanities EL' />";
                                echo"<br /><br />";
                                echo "<input type='submit' name='done' value='Done' />";  
                            }
                            else
                            {
                                echo "<input type='text' name='firstDis' size='20' placeholder='Enter Max First Disc' />";
                                echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                                echo "<input type='text' name='secondDis' size='20' placeholder='Enter Max Second Disc' />";
                                echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                                echo "<input type='text' name='humELmsc' size='20' placeholder='Enter Max Humanities EL' />"; 
                                echo "<br /><br />";
                                echo "<input type='submit' name='doneMsc' value='Done' />";  
                            } 
                            
                        }

                ?>    
            </form>


</body>
</html>

