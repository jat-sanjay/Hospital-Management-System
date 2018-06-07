<html>
<title>pastappointments</title>
<head>


<style>
body {
            background-image: url("black.jpg");
            
         }
</style>
<style type="text/css">
         p.example1{
            border:1px solid;
            border-bottom-color:#009900; /* Green */
            border-top-color:#FF0000;    /* Red */
            border-left-color:#330000;   /* Black */
            border-right-color:#0000CC;  /* Blue */
font-family:georgia,garamond,serif;
font-size:200%;
background-color: #993333;
         }
         
      </style>

</head>
<body style="text-align:center;font-size:200%;color:CC0066; font-family:courier">
<p class="example1">
     SANJEEVANI
      </p>










<?php
include("connection.php");
mysql_select_db('manobhav');
session_start();
$oipd=$_POST["oipd"];
$newdata=$_POST["newdata"];
$datee=date("Y-m-d");
$dat=$_POST["dat"];

if($oipd=='ipd')
{
if(isset($_POST["update"]))
	{
	$sql="update ipdpatient set case_file=concat(case_file,'$newdata') where p_code=".$_SESSION['p_code'];
	$retval=mysql_query($sql);
	echo "The patient file has been updated";
	//echo $retval;
	}
	else if(isset($_POST["close"]))
	{
		$sql="update patientdet set case_status='CLOSE' where p_code=".$_SESSION['p_code'];
		$retval=mysql_query($sql);
		echo "The patient's case has been closed.";
	}
}
else if($oipd=='opd')
{
	if(isset($_POST["close"]))
	{
		$sql="update patientdet set case_status='CLOSE' where p_code=".$_SESSION['p_code'];
		$retval=mysql_query($sql);
		echo "The patient's case has been closed.";
	}
	else if(isset($_POST["bookapp"]))
	{
		include("updateopd.php");
	$sql="update opdpatient set case_file='$newdata' where p_code=".$_SESSION['p_code']." and d='$datee'";
	$retval=mysql_query($sql);
	echo $retval;
	
	$sql="insert into opdpatient (p_code,dep,d,h_code) values(".$_SESSION['p_code'].",'".$_SESSION["dep"]."','$dat',".$_SESSION["h_code"].")";
$retval3=mysql_query($sql);
//echo $retval3;
echo "The next appointment is on '$dat'";
	$sql="update opd set ".$_SESSION["dep"]."=".$_SESSION["dep"]."-1 where H_CODE=".$_SESSION["h_code"]." AND d='$dat'";

$retval4=mysql_query($sql);
//echo $retval4;
	}
}
mysql_close($conn);
?>
<img src="heart.gif" alt="Mountain View" style="width:304px;height:310px; float:left;"">
</body>
</html>