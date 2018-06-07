<html>
<body>
<title>Welcome</title>
<head>
<style>
body {
            background-image: url("bricks.jpg");
            background-repeat: repeat;
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
$datee=date("y-m-d");
session_start();
$p_code=$_POST["p_code"];
$_SESSION['p_code']=$_POST["p_code"];
include("updateopd.php");
	$sql="select p_name from patientdet where p_code=$p_code";
	$retval=mysql_query($sql);
	$row=mysql_fetch_assoc($retval);

if($_POST["oipd"]=='ipd')
{
	$sql="select dep, case_file from ipdpatient where p_code=$p_code";
	$retval1=mysql_query($sql);
	$row1=mysql_fetch_assoc($retval1);
		echo "$p_code<br>".$row["p_name"]."<br><br>".$row1["dep"]."<br>".$row1["case_file"];
	?>
	<form action="docbooking.php" method="post">
	<textarea name='newdata' cols='40' rows='3'>Enter the prescription</textarea>
	<input type="hidden" name="oipd" style="cursor:pointer;text-align:center; font-size:100%;color:99CC00;font-family:georgia,garamond,serif;" value="ipd">
	<br>
	<input type="submit" name="update" style="cursor:pointer;text-align:center; font-size:100%;color:99CC00;font-family:georgia,garamond,serif;"value="Submit">
	<br>
	<input type="submit" name="close" style="cursor:pointer;text-align:center; font-size:100%;color:99CC00;font-family:georgia,garamond,serif;"value="Close Case">

<br>
	<?php
		
}
else
{

	echo "The patient name is".$row["p_name"]."<br>";
	$sql="select d,case_file from opdpatient where p_code=$p_code";
	$retval2=mysql_query($sql);
	while($row=mysql_fetch_assoc($retval2))
	{
		echo $row['d']."<br>".$row['case_file']."<br><br>";
	}
	
	$sql="select d from opd where H_CODE=".$_SESSION["h_code"]." AND ".$_SESSION["dep"].">=1 and d>='$datee'";
	$retval3=mysql_query($sql);
	
	?>
	<form action="docbooking.php" method="post">
	<textarea name='newdata' cols='40' rows='3' style="text-align:center;">$text</textarea><br><br>
	<input type="hidden" name="oipd" value="opd">
	<div align="center">
<select name="dat">
<?php while($row=mysql_fetch_assoc($retval3))
{?>
<option value="<?php echo $row['d'] ?>"> <?php echo $row['d'] ?></option>
<?php } ?>
</select>
<br><br>

</div>
	<input type="submit" name="bookapp" style="cursor:pointer;text-align:center; font-size:100%;color:99CC00;font-family:georgia,garamond,serif;"value="Submit and Book Appointment">
	<br><br>
	<input type="submit" name="close" style="cursor:pointer;text-align:center; font-size:100%;color:99CC00;font-family:georgia,garamond,serif;"value="Close Case">
<?php
	
}
mysql_close($conn);
?>

</body>
</html>
