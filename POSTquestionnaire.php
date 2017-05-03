<?php
//get the post variables
foreach($_REQUEST as $key => $value)
{
if($key =="name")
$name = $value;

if($key =="gender")
$gender = $value;

if($key =="age")
$age = $value;

if($key =="year")
$year =$value;

if($key =="month")
$month = $value;

if($key =="day")
$day = $value;

if($key =="height")
$height = $value;

if($key =="weight")
$weight = $value;

if($key =="bmi")
$bmi = $value;

if($key =="mri")
$mri = $value;

if($key =="bC")
$breathingC = $value;

if($key =="sC")
$sleepC = $value;

if($key =="gC")
$geneticC = $value;

if($key== "vC")
$visitC = $value;

if($key == "q8")
$q8C = $value;

if($key == "cC")
$cardiacC = $value;

if($key == "nC")
$neuroC = $value;

if($key == "nCC")
$neuroContinued = $value;

if($key == "biC")
$birthC = $value;

if($key == "wC")
$weightC = $value;

if($key == "rC")
$recentC = $value;

if($key == "mC")
$prescriptions = $value;


}

$score = 0;

//BMI SCORE calculation
if($age == 2 && $bmi > 19.2)
	$score = 1;
else if($age == 3 && $bmi > 18.4)
	$score = 1;
else if($age == 4 && $bmi > 17.8)
	$score = 1;
else if($age == 5 && $bmi > 17.95)
	$score = 1;
else if($age == 6 && $bmi > 18.5)
	$score = 1;
else if($age == 7 && $bmi > 19)
	$score = 1;
else if($age == 8 && $bmi > 20)
	$score = 1;
else if($age == 9 && $bmi > 21)
	$score = 1;
else if($age == 10 && $bmi > 22.1)
	$score = 1;
else if($age == 11 && $bmi > 23.2)
	$score = 1;
else if($age == 12 && $bmi > 24.3)
	$score = 1;
else if($age == 13 && $bmi > 25)
	$score = 1;
else if($age == 14 && $bmi > 26)
	$score = 1;
else if($age == 15 && $bmi > 26.6)
	$score = 1;
else if($age == 16 && $bmi > 27.45)
	$score = 1;
else if($age == 17 && $bmi > 28.2)
	$score = 1;
else if($age == 18 && $bmi > 28.7)
	$score = 1;
else if($age == 19 && $bmi > 29.6)
	$score = 1;
else if($age == 20 && $bmi > 30.45)
	$score = 1;
else
	$score = 3;



//Question 6 - loop for visit

$temp = "";
$vC = array("Radiologic Imaging (MRI/CT/Nuclear Medicine Scan or Other)","Surgery or other procedure (ex. Renal Biopsy or Joint Injection)" , "Child has cancer and needs Lumbar Puncture (LP) or Bone Marrow biopsy/aspiration", "Other" );
for( $i = 0; $i < strlen($visitC); $i++) {
	if($i != 0)
	{
		$temp.= ", ";
	}
	$char = substr($visitC,$i,1);
	$index = (int)$char;
	$temp .= $vC[$index];
	
}
$visitC = $temp;


//Scoring question 

//Question 8 - loop for q8
$tempScore = 0;
$temp = "";
$q8 = array("Has undergone sedation in the past", "Needed general anesthesia in the past", "Never had sedation/anesthesia", "Any family history of complications with anesthesia", "I dont know", "None" );
for( $i = 0; $i < strlen($q8C); $i++) {
	if($i != 0)
	{
		$temp.= ", ";
	}
	$char = substr($q8C,$i,1);
	$index = (int)$char;
	$temp .= $q8[$index];
	
	if($index == 0 || $index == 5)
		$tempScore += 5;
	else if($index == 1)
		$tempScore += 1;
	else if($index == 3)
		$tempScore += 2;
	else 
		$tempScore += 3;
}
$score += ($tempScore / strlen($q8C));
$q8C = $temp;


//Question 9 - loop for breathing
$tempScore = 0;
$temp = "";
$bC = array( "Recent history or current stridor", "Recent history or current wheezing", "Recent evidence of lower respiratory tract infection (Pneumonia, Bronchiolitis)", "Recent respiratory infection last 4 weeks < age 1 year", "Recent respiratory infection last 2 weeks > age 1 year", "Evidence of recent purulent rhintis or sinusitis", "Airway Malazia(Laryngomalacia, Tracheamalacia or Bronchomalacia)" , "Has severe scoliosis compromising breathing", "Home oxygen use","H/o cystic fibrosis","H/o asthma", "Chronic cough", "Chronic lung disease (CLD)" , "None" );
for( $i = 0; $i < strlen($breathingC); $i++) {
	if($i != 0)
	{
		$temp.= ", ";
	}
	$char = substr($breathingC,$i,1);
	
	if($char == 'A')
	{
		$index = 10;
	}
	else if($char == 'B')
	{
		$index = 11;
	}
	else if($char == 'C')
	{
		$index = 12;
	}
	else if($char == 'D')
	{
		$index = 13;
	}
	else
	{
		$index = (int)$char;
	}

	$temp .= $bC[$index];
	
	if($index == 13)
		$tempScore +=5;
	else if($index == 2 || $index == 3 || $index == 5)
		$tempScore += 2;
	else if($index == 11 || $index == 10 || $index == 9 )
		$tempScore += 3;
	else
		$tempScore += 1;
		
}
$score += ($tempScore / strlen($breathingC));
$breathingC = $temp;

//Question 10 - loop for cardiac
$tempScore = 0;
$temp = "";
$cC = array("History of any cardiac disease", "Congestive heart failure", "Myocarditis/Cardiomyopathy", "History of arrhythmias or on therapy for arrhythmia", "Has history of REPAIRED congenital hearth disease", "Has history of UNREPAIRED congenital hearth disease", "History of pulmonary hypertension", "History of vascular ring", "History of heart disease and his/her recent health status is deteriorating" , "None" );
for( $i = 0; $i < strlen($cardiacC); $i++) {
	if($i != 0)
	{
		$temp.= ", ";
	}
	
	$char = substr($cardiacC,$i,1);
	$index = (int)$char;
	$temp .= $cC[$index];
	
	if($index == 9)
		$tempScore += 5;
	else if($index == 4)
		$tempScore += 3;
	else if($index == 1 || $index == 5 || $index == 2)
		$tempScore += 1;
	else
		$tempScore += 2;
}
$score += ($tempScore / strlen($cardiacC));
$cardiacC = $temp;


//Question 11 - loop for neurology
$tempScore = 0;
$temp = "";
$nC = array("My child has been diagnosed with an Autism Spectrum disorder" , "Inability to control secretions", "Not allowed to feed by mouth due to aspiration risk" ,"Weakness or hypotonia", "Difficulty swallowing", "None" );
for( $i = 0; $i < strlen($neuroC); $i++) {
	if($i != 0)
	{
		$temp.= ", ";
	}
	
	$char = substr($neuroC,$i,1);
	$index = (int)$char;
	$temp .= $nC[$index];
	
	if($index == 5)
		$tempScore += 5;
	else if($index == 1)
		$tempScore += 3;
	else if($index == 0 || $index == 2 || $index == 3)
		$tempScore += 2;
	else if($index == 4)
		$tempScore += 1;
	
}
$score += ($tempScore / strlen($neuroC));
$neuroC = $temp;


//Question 12 - loop for neurology continued
$tempScore = 0;
$temp = "";
$nCC = array("Able to sit up without support", "Able to hold head up", "Able to crawl", "Able to stand", "Able to walk", "Not applicable" );
for( $i = 0; $i < strlen($neuroContinued); $i++) {
	if($i != 0)
	{
		$temp.= ", ";
	}
	
	$char = substr($neuroContinued,$i,1);
	$index = (int)$char;
	$temp .= $nCC[$index];
	
	if($index == 5 || $index == 1)
		$tempScore += 5;
	else 
		$tempScore += 4;
	
}
$score += ($tempScore / strlen($neuroContinued));
$neuroContinued = $temp;



//Question 13 - loop for sleep
$tempScore = 0;
$temp = "";
$sC = array( "Recent sleep study positive for obstructive sleep apnea (OSA)", "Wakes up to breathe or has respiratory pauses during sleep", "Snores loudly OR if infant has noisy breathing during sleep", "Assumes bizarre positions during sleep (example neck hypertension)", "I have an appointment for sleep study", "None");
for( $i = 0; $i < strlen($sleepC); $i++) {
	if($i != 0)
	{
		$temp.= ", ";
	}
	$char = substr($sleepC,$i,1);
	$index = (int)$char;
	$temp .= $sC[$index];
	
	if($index == 4)
		$tempScore += 3;
	else if($index == 5)
		$tempScore += 5;
	else
		$tempScore += 1;
	
}
$score += $tempScore / strlen(sleepC);
$sleepC = $temp;


//Question 14 - loop for genetic
$tempScore = 0;
$temp = "";
$gC = array( "Down Syndrome", "Pierre Robin" , "Mitochondrial disorder" , "Beckwith Weidman", "Goldenhars" , "Apert" , "Mucopolysacchariodosis", "Treacher Collins", "Achondroplasia" , "Williams Syndrome", "Duchenne Muscular Dystrophy", "None");

for( $i = 0; $i < strlen($geneticC); $i++) {
	if($i != 0)
	{
		$temp.= ", ";
	}

	$char = substr($geneticC,$i,1);

	if($char == 'A')
	{
		$index = 10;
	}
	else if($char == 'B')
	{
		$index = 11;
	}
	else
	{
		$index = (int)$char;
	}
	
	$temp .= $gC[$index];
	
	if($index == 11)
		$tempScore += 5;
	else
		$tempScore +=1;
}
$score += ($tempScore / strlen($geneticC));
$geneticC= $temp;


//Question 15 - loop for birth history
$tempScore = 0;
$temp = "";
$biC = array("Premature birth (born <37 weeks gestational age)", "Born at 32-37 weeks gestation", "Born at 28-32 weeks gestation", "Born < 28 weeks gestation", "My childs post-conceptual age is less than 60 weeks",  "My child was intubated and mechanically ventilated in the NICU", "My child was on oxygen after birth", "None" );
for( $i = 0; $i < strlen($birthC); $i++) {
	if($i != 0)
	{
		$temp.= ", ";
	}
	
	$char = substr($birthC,$i,1);
	$index = (int)$char;
	$temp .= $biC[$index];
	
	if($index == 0)
		$tempScore += 2;
	else if($index == 7)
		$tempScore += 5;
	else
		$tempScore += 1;
		
}
$score += ($tempScore/ strlen($birthC));
$birthC = $temp;


//Question 16 - loop for weight choices
$tempScore = 0;
$temp = "";
$wC = array("There is history of recent weight gain", "History of steroid use for a long time", "My childs anesthesia/sedation has been difficult in the past due to body weight", "Obtaining intravenous access (IV) has been difficult in the past due to body weight", "None" );
for( $i = 0; $i < strlen($weightC); $i++) {
	if($i != 0)
	{
		$temp.= ", ";
	}
	
	$char = substr($weightC,$i,1);
	$index = (int)$char;
	$temp .= $wC[$index];
	
	if($index == 0 || $index == 1)
		$tempScore += 2;
	else if($index == 2 || $index == 3)
		$tempScore += 1;
	else if($indez == 4)
		$tempScore += 5;
}
$score += ($tempScore / strlen($weightC));
$weightC = $temp;

//Question 17 - loop for recent events
$temp = "";
$rC = array("Admitted to hospital", "Had a visit to the Emergency department in past 48 hours", "Not Applicable" );
for( $i = 0; $i < strlen($recentC); $i++) {
	if($i != 0)
	{
		$temp.= ", ";
	}
	
	$char = substr($recentC,$i,1);
	$index = (int)$char;
	$temp .= $rC[$index];
	
	if($index == 0)
		$score += 2;
	else if($index == 1)
		$score += 2;
	else if($index == 2)
		$score += 5;
	
}
$recentC = $temp;



//FINAL SCORE
$score = $score / 10;


//connect to the database
$con=mysqli_connect("localhost","choa_dbuser","O{LVO-wPo=6}","choa_database");// server, user, pass, database


// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$trimmedName = str_replace(' ','|',$name);
$lowerCaseName = strtolower($trimmedName);

$name = $trimmedName;
//update the value
if($name === NULL || nCC === NULL)
{
}
else if(!mysqli_query($con,"INSERT INTO PatientInfo (Name, Score, Gender, Age, Month, Day, Year, Height, Weight, BMI, MRI,Q6, Q8, Q9, Q10, Q11, Q12, Q13, Q14, Q15, Q16, Q17, Prescription ) VALUES ('$name','$score','$gender','$age','$month','$day','$year','$height','$weight','$bmi','$mri','$visitC','$q8C','$breathingC','$cardiacC','$neuroC','$neuroContinued','$sleepC','$geneticC','$birthC','$weightC','$recentC','$prescriptions')"))
{
echo("Error description: " . mysqli_error($con));

}
//echo "inserted '$name','$score','$gender','$age','$month','$day','$year','$height','$weight','$bmi','$mri','$visitC','$q8C','$breathingC','$cardiacC','$neuroC','$neuroContinued','$sleepC','$geneticC','$birthC','$weightC','$recentC','$prescriptions' ";

mysqli_close($con);




//go back to the interface
//header("location: interface.php");


?>