<html>
<body>
<title>Welcome<</title>
<head>


<style>
body {
            background-image: url("new.jpg");
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
background-color: #993333;
         }
         
      </style>

</head>
<body style="text-align:center;font-size:200%;color:CC0066; font-family:courier">
<p class="example1">
     SANJEEVANI
      </p>
	<h2 style="cursor:pointer;text-align:center; font-size:150%;color:99CC00;font-family:georgia,garamond,serif">LOGIN</h2>
<?php
include("connection.php");

         

         // define variables and set to empty values
         $cat_type = $h_code =$pass="";
         
         function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
         }
      
            $cat_type = test_input($_POST["cat_type"]);
            $h_code = test_input($_POST["h_code"]);
		$pass=$_POST["pass"];
session_start();


mysql_select_db('manobhav');
if($cat_type=='Govtp')
{
$sql = "SELECT p.H_CODE,g.sg_name FROM paramedics p,govt_hospital g where passp='$pass' and H_CODE=sg_code";

            $retval = mysql_query( $sql);


if(! $retval)
{
echo 'could not give data';
}
$row = mysql_fetch_assoc($retval);
if($row['H_CODE']==$h_code)
{
	echo"Welcome to ".$row['sg_name']." Paramedic";
	
	$_SESSION["h_code"] = $_POST["h_code"];
	?>
	<a href="register_patient.html" style="cursor:pointer;text-align:center; font-size:100%;color:FF00CC;font-family:courier">Register Patient</a>
	<a href="hospitalassignment.html" style="cursor:pointer;text-align:center; font-size:100%;color:FF00CC;font-family:courier">Assign Hospital</a>
<?php	
	
}
else
{
	echo "Invalid User";?>
	<a href="loginhtml.html" style="cursor:pointer;text-align:center; font-size:100%;color:FF00CC;font-family:courier">Go back</a><br>
	<?php
}
 
}
else if($cat_type=='Privd')
{
	$sql = "SELECT p.H_CODE,p.h_name,d.dep FROM priv_hospital p,priv_doctor d where d.pass='$pass' and p.H_CODE=d.H_CODE";

            $retval = mysql_query( $sql);


if(! $retval)
{
echo 'could not give data';
}
$row = mysql_fetch_assoc($retval);
if($row['H_CODE']==$h_code)
{
	echo"Welcome to the ".$row["dep"]." department of ".$row['h_name']." Doctor";
	
	$_SESSION["h_code"] = $_POST["h_code"];
	$_SESSION["dep"]=$row["dep"];
	?>
	<form action="docappassign.php" method="POST">
	<input type="radio" name="oipd" value="opd" > OPD
<br><br>
<input type="radio" name="oipd" value="ipd"> IPD
<br>
<input type ="text" style="cursor:pointer;text-align:center; font-size:150%;color:FF00CC;font-family:courier" name="p_code">
<br>
<input type="submit" style="cursor:pointer;text-align:center; font-size:100%;color:99CC00;font-family:georgia,garamond,serif;background-color: #9933CC" value="Submit">
<br>
</form>
<?php	
	
}
else
{
	echo "Invalid User";?>
	<a href="loginhtml.html" style="cursor:pointer;text-align:center; font-size:100%;color:FF00CC;font-family:courier">Go back</a><br>
	<?php
}
	
}

else if($cat_type=='Pat')
{
	$sql = "SELECT p_name, p_code FROM patientdet where p_pass='$pass'";

            $retval = mysql_query( $sql);


if(! $retval)
{
echo 'could not give data';
}
$row = mysql_fetch_assoc($retval);
if($row['p_code']==$h_code)
{
	echo"Welcome ".$row["p_name"];
	
	$_SESSION["p_code"] = $_POST["h_code"];
	echo "review today's appointment";

	?>
	<form action="patientrev.php" method="POST">

<input type ="text" style="cursor:pointer;text-align:center; font-size:100%;color:99CC00;font-family:courier" name="rev">
<br>
<input type="submit" style="cursor:pointer;text-align:center; font-size:100%;color:99CC00;font-family:georgia,garamond,serif;background-color: #9933CC" value="Submit">
<br>
</form>
<form action="dispatfile.php" method="POST">
<input type="hidden" style="cursor:pointer;text-align:center; font-size:150%;color:99CC00;font-family:courier" name="oipd" value='opd'>
<input type="hidden" name="p_code" value=<?php echo $_POST["h_code"]; ?>>
<input type="submit" style="cursor:pointer;text-align:center; font-size:120%;color:99CC00;font-family:courier" name="past" value="View Past Appointments">
<input type="submit" style="cursor:pointer;text-align:center; font-size:120%;color:99CC00;font-family:courier" name="next" value="View Next Appointment">
<input type="submit" style="cursor:pointer;text-align:center; font-size:120%;color:99CC00;font-family:courier" name="notif" value="My Notifications">
<br>
</form>
<?php	
	
}
else
{
	echo "Invalid User";?>
	<a href="loginhtml.html" style="cursor:pointer;text-align:center; font-size:100%;color:6666CC;font-family:courier">Go back</a><br>
	<?php
}
	
}
else if($cat_type=='Govth')
{
$sql = "SELECT sg_code,sg_name FROM govt_hospital  where pass='$pass' and sg_code=$h_code";

            $retval = mysql_query( $sql);

if(! $retval)
{
echo 'could not give data';
}
$row = mysql_fetch_assoc($retval);
if($row['sg_code']==$h_code)
{
	echo"Welcome to ".$row['sg_name'];

$_SESSION["pass"]=$_POST['pass'];
$_SESSION["sg_code"]=$row['sg_code'];
?>
<form action="display.php" method="POST">
<table>
<tr>
<br><br>
<tr>
<td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="radio" name="oipd" value="opd" > OPD PATIENT DETAILS</td>
<td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="radio" name="oipd" value="ipd">  IPD PATIENTS DETAILS</td>
<td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="radio" name="oipd" value="rev" >  DOCTORS DETAILS</td>
</tr>
</table>
<br><br>
<input type="submit" style="cursor:pointer;text-align:center; font-size:100%;color:99CC00;font-family:georgia,garamond,serif;background-color: #9933CC"value="Submit" align="center">
</form>
<?php
}
else
{
echo "Invalid user";?>
	<a href="loginhtml.html" style="cursor:pointer;text-align:center; font-size:100%;color:6666CC;font-family:courier">Go back</a><br>
	<?php

}
}
else if($cat_type=='Privh')
{
$sql = "SELECT H_CODE,h_name FROM priv_hospital  where password='$pass' and H_CODE=$h_code";

            $retval = mysql_query( $sql);


if(! $retval)
{
echo 'could not give data';
}
$row = mysql_fetch_assoc($retval);
if($row['H_CODE']==$h_code)
{

echo"Welcome to ".$row['h_name'];

$_SESSION["pass"]=$_POST['pass'];
$_SESSION["h_code"]=$_POST['h_code'];
?>
<form action="displayp.php" method="POST">
<table>
<tr>
<br><br>
<tr>
<td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="radio" name="oipd" value="opd" > OPD PATIENT DETAILS</td>
<td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="radio" name="oipd" value="ipd">  IPD PATIENTS DETAILS</td>
<td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="radio" name="oipd" value="rev" >  DOCTORS DETAILS</td>
</tr>
</table>
<br><br>
<input type="submit" style="cursor:pointer;text-align:center; font-size:100%;color:99CC00;font-family:georgia,garamond,serif;background-color: #9933CC" value="Submit" align="center">
</form>
<?php
}
else
{
echo "Invalid user";?>
	<a href="loginhtml.html"  style="cursor:pointer;text-align:center; font-size:100%;color:6666CC;font-family:courier">Go back</a><br>
	<?php

}
} 

            
            mysql_close($conn);
			?>
            



</body>
</html>