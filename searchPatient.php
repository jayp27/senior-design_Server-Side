<html>
<head>
</head>
<body>  

<u><b>Search Patient</b></u><br />

<form action="choa2.php" method="post" name="searchform">
	<table>
		<tr>
			<td>Name: </td>
			<td><input type = "text" name = "fullname" placeholder="First and Last name" style ="color:#888;" required/></td>
		</tr>
		
		
		<tr>
			<td>Date of Birth: </td>
			
			
			 <td><input type="date" name="bday"></td>
			
		</tr>
		
		<tr>
			<td></td>
			<td>
			<input type = "submit" name = "submit">
			</td>
		</tr>
	</table>
</form>




<?php

ob_start();
	if(isset($_POST['submit'])){
		
		
		$name = $_POST['fullname'];
		$sqlName = str_replace(' ','|',$name);
		$trimmedName = str_replace(' ','',$name);
		$lowerCaseName = strtolower($trimmedName);
	
		$bd = $_POST['bday'];
		$trimBD = str_replace('-','',$bd);
		
		//YYYYMMDD
		//01234567
		$year = substr($trimBD,0,4);
		$month = substr($trimBD,4,2);
		$day = substr($trimBD,6,2);
		$dobd = $day;
		$dobm = $month;
		
		
		if($month[0] == 0)
		{
			$tempM = substr_replace($month, '', 0,1);
			$month = $tempM;
		}
		if($day[0] == 0)
		{
			$tempD = substr_replace($day, '', 0,1);
			$day = $tempD;
		}
		//echo "year: ".$year." month: ".$month." day: ".$day; 
		
		//SELECT * FROM table WHERE column1 = 'var1' AND column2 = 'var2';
		
		$con=mysqli_connect("localhost","choa_jay","O{LVO-wPo=6}","choa_database");
		// Check connection
		if (mysqli_connect_errno())
  		{
 		 echo "Failed to connect to MySQL: " . mysqli_connect_error();
  		}
  		else
  		{
  		
	  		//echo $sqlName.$year.$month.$day;
	  		// Name = ".$sqlName." AND
			$query = "SELECT * FROM PatientInfo WHERE Name = '".$sqlName."' AND Year = ".$year." AND Month = ".$month." AND Day = ".$day;
			//echo $query;
			$result = mysqli_query($con,$query);
		
			if(mysqli_num_rows($result)==0)
			{
				echo "Patient Not Found";
				echo "<br />";
		 	}
		 	else
		 	{
		 		$row = mysqli_fetch_array($result);
				
				
				
				//Trimming bday to match the format of image name stored in the server
				if($trimBD[4] == 0)
				{
					$trimBD = substr_replace($trimBD, '', 4,1);
					
					if($trimBD[5] == 0)
					{
						$trimBD = substr_replace($trimBD, '', 5,1);
					}
				}
				else if($trimBD[6] == 0)
				{
					$trimBD = substr_replace($trimBD, '', 6,1);
				}
				
				
				$tempScore = $row['Score'];
				$score = substr($tempScore,0,3);
				if($score < 1)
				{	
					$score = 1;
				}
				if($score >5)
				{
					$score = 5;
				}
				echo "<b>Score: </b>".$score;
				echo "<br />";
						
				//$dob = $trimBD;
				$sppp = " ";
				$MRI = $row['MRI'];
				if($MRI === "Yes")
				{
				echo "MRI: ".$sppp."<div style=\"color: red;\"> ".$MRI;
				echo "</div><br />";
				}
				else
				{
				echo "<b>MRI: </b>".$MRI;
				echo "<br />";
				}
				
				echo "<b>Patient Name: </b>".$name;
				echo "<br />";
				
				$gender = $row['Gender'];
				echo "<b>Gender: </b>".$gender;
				echo "<br />";
			
				echo "<b>DOB: </b>".$dobm."-".$dobd."-".$year;
				echo "<br />";
				
				$height = $row['Height'];//in centimeters
				// convert centimetres to inches
				$inches = round($height/2.54);
				// now find the number of feet...
				$feet = floor($inches/12);
				// ..and then inches
				$inches = ($inches%12);
				echo "<b>Height: </b>".$feet."'" .$inches;
				echo "<br />";
				
				$weight = $row['Weight'];
				echo "<b>Weight: </b>".$weight." lbs";
				echo "<br />";
				
				$bmi = $row['BMI'];
				echo "<b>BMI: </b>".substr($bmi,0,5);
				echo "<br />";
				
				$q6 = $row['Q6'];
				echo "<b>Reason for visit: </b>".$q6;
				echo "<br />";
				
				$q7 = $row['Q7'];
				echo "<b>Any metals in body: </b>".$q7;
				echo "<br />";
				
				$q8 = $row['Q8'];
				echo "<b>The following applies to child: </b>".$q8;
				echo "<br />";
				
				$q9 = $row['Q9'];
				echo "<b>Childs breathing condition(s): </b>".$q9;
				echo "<br />";
				
				$q10 = $row['Q10'];
				echo "<b>Childs cardian history: </b>".$q10;
				echo "<br />";
				
				$q11 = $row['Q11'];
				echo "<b>Neurology: </b>".$q11;
				echo "<br />";
				
				$q12 = $row['Q12'];
				echo "<b>The child is under 4 years old and the following applies: </b>".$q12;
				echo "<br />";
				
				$q13 = $row['Q13'];
				echo "<b>Sleeping habits(s)/pattern(s): </b>".$q13;
				echo "<br />";
				
				$q14 = $row['Q14'];
				echo "<b>Child is diagnosed with the following: </b>".$q14;
				echo "<br />";
				
				$q15 = $row['Q15'];
				echo "<b>Childs birth history: </b>".$q15;
				echo "<br />";
				
				$q16 = $row['Q16'];
				echo "<b>Childs weight: </b>".$q16;
				echo "<br />";
				
				$q17 = $row['Q17'];
				echo "<b>Child was recently: </b>".$q17;
				echo "<br />";
				
				$q18 = $row['Prescription'];
				echo "<b>Prescription(s): </b>".$q18;
				echo "<br />";
				
				
				$dirname = "imagesTest/";
				
				//front image name
				$imgFront = $lowerCaseName.$trimBD."front.jpg";
				$imgSide = $lowerCaseName.$trimBD."side.jpg";
				
				
				$images = glob($dirname.$imgFront);
			
				echo '<tr>';
					
		
		   		foreach($images as $image) {
		   		echo '<td><img src="'.$image.'"width = "384" height = "512" /></td>';
				}
				$dirname = "imagesTest/";
				
				echo "     ";
				$images = glob($dirname.$imgSide);
		
				//image url
				//$imageSideURL = "a href=\"http://choa.engr.uga.edu/imagesTest/".$imgSide;
		   		foreach($images as $image) {
		   		echo '<td><img src="'.$image.'"width = "384" height = "512" /></a></td><br />';
					
		   		//echo '<td><a href="http://choa.engr.uga.edu/imagesTest/".$imgSide." target="_blank"><img src="'.$image.'"width = "384" height = "600" /></a></td><br />';
					
				}
			 	echo '</tr>';
		 	}
	    }
	
	}
ob_end_flush();

?>





</body>
</html>