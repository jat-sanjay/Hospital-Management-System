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
$datee=date("Y-m-d");
if(isset($_POST["past"]))
{
if($_POST["oipd"]=='ipd')
{$sql="select case_file from ipdpatient where p_code=".$_POST["p_code"];
$retval=mysql_query($sql);
$row=mysql_fetch_assoc($retval);
echo $row["case_file"] ;}



else
{$sql="select d, case_file from opdpatient where p_code=".$_POST["p_code"]." and d<'$datee'";
$retval=mysql_query($sql);
while($row=mysql_fetch_assoc($retval))
{
	echo $row['d']."\n".$row['case_file'];
        echo"<br><br>";
}
}
}
else if(isset($_POST["next"]))
{
	$sql="select d,dep from opdpatient where p_code=".$_POST["p_code"]." and d>'$datee'";
	$retval=mysql_query($sql);
$row=mysql_fetch_assoc($retval);
echo "Howdy Patient, your next appointment is on ".$row['d']." in the ".$row['dep']." ward at 5pm.Please be there on time.";

}

else if(isset($_POST["notif"]))
{
	$sql="select d,dep,Comments from pat_notif where p_code=".$_POST["p_code"];
	$retval=mysql_query($sql);
$row=mysql_fetch_assoc($retval);
echo "Howdy Patient, your next apointment was deleted as you had not reviewed your previous appointment. If you were unaware of the appointment please contact your nearest paramedic immediately. The appointment details are-";
echo $row["d"].",".$row["dep"].",".$row["Comments"];
}
?>

<img src="cartoon_hospital_eart_a_hb.gif" alt="Mountain View" style="width:504px;height:310px; float:right;"">
</body>
</html>
